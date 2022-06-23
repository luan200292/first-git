<?php
namespace App\Form\Type;

use App\Entity\Part;
use App\Entity\Supplier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartType extends AbstractType{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Part::class
        ]);
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class)
        ->add('price', TextType::class)
        ->add('quantity', null, [
            'required'=>false,
            'empty_data' => '1'
        ])
        ->add('supplier', EntityType::class,[
            'class'=> Supplier::class,
            'choice_label'=>'id'
        ])
        ->add('save', SubmitType::class,[
            'label'=>"Save"
        ])
        ;
    }
}

?>