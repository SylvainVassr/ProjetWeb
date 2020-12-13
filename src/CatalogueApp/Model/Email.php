<?php


namespace Vassagnez\CatalogueApp\Model;


class email
{
    private $lienPdf;

    /**
     * email constructor.
     * @param $lienPdf
     */
    public function __construct($lienPdf)
    {
        $this->lienPdf = $lienPdf;
    }

    /**
     * Méthode qui permet d'envoyer le mail quand on achète un pdf
     * @param $mail
     */
    public function sendMail($mail)
    {
        $to = $mail;
        $subject = 'Achat d\'un pdf';
        $from = 'toto@email.com';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        $message = '<html><body>';
        $message .= '<h1>Bonjour,</h1>';
        $message .= "<p>Tu viens de réaliser un achat d'un pdf sur notre site Catalogue PDF. Voici le lien de téléchargement : <a href='$this->lienPdf' download>clique ici</a></p>";
        $message .= '</body></html>';

        // Envoi d'email
        if(mail($to, $subject, $message, $headers)){
            echo "<script>alert(\"Votre message a été envoyé avec succès.\")</script>";
        } else{
            echo "<script>alert(\"Impossible d\'envoyer des courriels. Veuillez réessayer.\")</script>";
        }
    }
}