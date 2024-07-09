<?php

return [
  'required' => 'O campo :attribute é obrigatório.',
  'email' => 'O campo :attribute deve ser um endereço de email válido.',
  'min' => [
    'string' => 'O campo :attribute não deve ter menos que :min caracteres.',
    'file' => 'O campo :attribute não deve ser menor que :min kilobytes.',
  ],
  'max' => [
    'string' => 'O campo :attribute não deve ter mais que :max caracteres.',
    'file' => 'O campo :attribute não deve ser maior que :max kilobytes.',
  ],
  'size' => [
    'file' => 'O campo :attribute deve ter entre :min e :max kilobytes.',
  ],
  'between' => [
    'file' => 'O campo :attribute deve ter entre :min e :max kilobytes.',
  ],
  'confirmed' => 'A confirmação do campo :attribute não corresponde.',
  'unique' => 'O campo :attribute já está em uso.',
  'mimes' => 'O campo :attribute deve ser um arquivo do tipo: :values.',
  'file' => 'O campo :attribute deve ser um arquivo.',
];
