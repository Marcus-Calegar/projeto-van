<?php
interface IUser
{
    public static function setDataNascimento($dataNascimento);
    public static function setSenha($senha);
    public function Inserir($data);
    public function Atualizar($data);
    public static function ExcluirPerfil($id);
    public static function Logar($email, $senha);
}
