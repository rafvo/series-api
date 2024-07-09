<?php

namespace App\Http\Services;

use Emarref\Jwt\Algorithm;
use Emarref\Jwt\Claim;
use Emarref\Jwt\Jwt;
use Emarref\Jwt\Token;
use Emarref\Jwt\Verification\Context;
use App\Exceptions\TokenInvalidException;
use Emarref\Jwt\Encryption;

class EmarrefJwtService
{
  protected $jwt;
  protected $encryption;
  protected $issuer;

  public function __construct()
  {
    $algorithm = new Algorithm\Hs256(env('JWT_SECRET'));

    $this->encryption = Encryption\Factory::create($algorithm);
    $this->issuer = env('APP_NAME');
    $this->jwt = new Jwt();
  }

  /**
   * Gera um token JWT para um determinado usuário.
   *
   * @param int $userId
   * @return string
   */
  public function generateToken(int $userId): string
  {
    $token = new Token();

    $token->addClaim(new Claim\Issuer($this->issuer));
    $token->addClaim(new Claim\Subject("$userId"));
    $token->addClaim(new Claim\Expiration(time() + 3600));

    return $this->jwt->serialize($token, $this->encryption);
  }

  public function deserializeTokenString(string $tokenString): Token
  {
    try {
      return $this->jwt->deserialize($tokenString);
    } catch (\Exception $e) {
      throw new TokenInvalidException('Falha na desserialização do token: ' . $e->getMessage());
    }
  }

  public function getSubjectFromToken(Token $token): ?string
  {
    $subjectClaim = $token->getPayload()->findClaimByName('sub');

    return $subjectClaim ? $subjectClaim->getValue() : null;
  }

  /**
   * Verifica a validade de um token JWT.
   *
   * @param string $tokenString
   * @return bool
   * @throws TokenInvalidException
   */
  public function verifyToken(string $tokenString): bool
  {
    try {
      $token = $this->deserializeTokenString($tokenString);
      $subject = $this->getSubjectFromToken($token);

      // Cria um contexto para verificação do token
      $context = new Context($this->encryption);
      $context->setIssuer($this->issuer);
      $context->setSubject($subject);

      // Verifica se o token JWT é válido
      $this->jwt->verify($token, $context);

      $issuerClaim = $token->getPayload()->findClaimByName(Claim\Issuer::NAME);

      if (!$issuerClaim) {
        throw new TokenInvalidException('Issuer está ausente.');
      }

      $issuerValue = $issuerClaim->getValue();

      if ($issuerValue !== $this->issuer) {
        throw new TokenInvalidException('Issuer inválido.');
      }

      $expirationClaim = $token->getPayload()->findClaimByName(Claim\Expiration::NAME);

      if ($expirationClaim && $expirationClaim->getValue() < time()) {
        throw new TokenInvalidException('Token expirado.');
      }

      return true;
    } catch (\Exception $e) {
      throw new TokenInvalidException('Token inválido: ' . $e->getMessage());
    }
  }
}
