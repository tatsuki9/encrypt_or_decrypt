<?php

$error = 0;
if (!preg_match('/^type=(encrypt|decrypt)$/', $argv[1], $m1))
{
	echo "暗号化または複合化どちらかを選択してください\n<書式 type=encrypt または type=decrypt>\n\n";
	$error = 1;
}
if (!preg_match('/^c=(.+)$/', $argv[2], $m2))
{
	echo "暗号対象または複合対象の文字列を入力してください\n<書式 c=文字列>\n\n";
	$error = 1;
}
if (!preg_match('/^s=(.+)$/', $argv[3], $m3))
{
	echo "秘密鍵を入力してください\n<書式 s=秘密鍵>\n";
	$error = 1;
}
if ($error)
{
	return;
}

//openssl
$result = null;
if ($m1[1] == 'encrypt')
{
	$result = openssl_encrypt($m2[1], 'AES-128-ECB', $m3[1]);
}
else
{
	$result = openssl_decrypt($m2[1], 'AES-128-ECB', $m3[1]);
}
if (!$result)
{
    echo "暗号化もしくは復号化に失敗しました\n";
}

echo $result, PHP_EOL;
