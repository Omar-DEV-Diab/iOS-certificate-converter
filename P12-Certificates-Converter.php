<?php
/**
 * Created by PhpStorm.
 * User: omardiab
 * Date: 4/1/19
 * Time: 11:35 AM
 */

echo "********".PHP_EOL;
echo "********".PHP_EOL;
echo "******** please make sure that the Certificates are placed where i am ******".PHP_EOL;
echo "ARE YOU SURE ? N/Y".PHP_EOL;
$input = rtrim(fgets(STDIN));
if ($input == "Y"){
    echo "Enter file name (without .p12): ";
    $filename = rtrim(fgets(STDIN));

    echo "Enter password: ";
    $password = rtrim(fgets(STDIN));

    system("openssl pkcs12 -clcerts -nokeys -out $filename-apns-dev-cert.pem -in $filename.p12 -passin pass:$password");
    system("openssl pkcs12 -nocerts -out $filename-apns-dev-key.pem -in $filename.p12 -passout pass:$password -passin pass:$password");
    system("openssl rsa -in $filename-apns-dev-key.pem -out $filename-apns-dev-key-noenc.pem -passin pass:$password");
    system("cat $filename-apns-dev-cert.pem $filename-apns-dev-key-noenc.pem > APN_$filename_CombinedKey.pem");

    system("rm $filename-apns-dev-key.pem");
    system("rm $filename-apns-dev-key-noenc.pem");
    system("rm $filename-apns-dev-cert.pem");

    echo ("now you have created 『APN_$filename_CombinedKey.pem』 ");
}else{
    exit(" MOVE Certificates to where i am");
}
