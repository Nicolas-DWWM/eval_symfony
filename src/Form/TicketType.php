<?php

namespace App\Form;

use App\Entity\Category;
//use App\Entity\Status;
use App\Entity\Ticket;
//use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TicketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', EmailType::class, [
                'label' => 'Votre adresse e-mail',
                'attr' => ['placeholder' => 'exemple@agence.com']
            ])
            //->add('createdAt', null, [
                //'widget' => 'single_text',
            //])
            //->add('closedAt', null, [
                //'widget' => 'single_text',
            //])
            ->add('description', TextareaType::class, [
                'label' => 'Description du problème',
                'attr' => [
                    'placeholder' => 'Décrivez votre demande (entre 20 et 250 caractères)',
                    'rows' => 5
                ]
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'placeholder' => 'Choisissez une catégorie'
            ])
            //->add('status', EntityType::class, [
                //'class' => Status::class,
                //'choice_label' => 'id',
            //])
           // ->add('responsible', EntityType::class, [
                //'class' => User::class,
                //'choice_label' => 'id',
            //])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
