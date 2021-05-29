<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class SendEmailController extends AbstractController
{
    /**
     * @Route("/correo", name="correo")
     */
    public function sendEmail(Request $request, MailerInterface $mailer)
    {
        $user = new User();
        $form = $this->createForm(EmailType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form['Clientes']->getData();
            $userPass = $form['Password']->getData();


        $userEmail = $user->getEmail();


            $email = (new Email())
                ->from('freemarket@example.com')
                ->to($userEmail)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject('Time for Symfony Mailer!')
                ->text('Usuario '.$userEmail.' contraseña '.$userPass)
                ->html('<p>Queremos darte la bienvenida a FreeMarket, Estos son tus datos de acceso:</p><p>Usuario</p>'.$userEmail.'<p>Contraseña</p>'.$userPass);

            $mailer->send($email);
            $response = new RedirectResponse('/admin');
            return $response;
        }
            return $this->render('user/sendEmail.html.twig', [
                'form' => $form->createView(),

            ]);

        }

}