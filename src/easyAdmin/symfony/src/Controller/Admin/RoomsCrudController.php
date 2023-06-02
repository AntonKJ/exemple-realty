<?php

namespace App\Controller\Admin;

use App\Entity\Rooms;
use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;


class RoomsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rooms::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Room')
            ->setEntityLabelInPlural('Rooms')
            ->setSearchFields(['title', 'text', 'id'])
            ->setDefaultSort(['publishDate' => 'DESC']);
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('title'))
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        /*            return [
                        IdField::new('id'),
                        TextField::new('title'),
                        TextEditorField::new('text'),
                    ];*/
        yield AssociationField::new('categories', 'Categories')->autocomplete()->hideOnIndex();
        yield AssociationField::new('works', 'Works')->autocomplete()->hideOnIndex();
        //yield AssociationField::new('title');
        //yield TextField::new('categories.fullName');
        yield TextField::new('title');
        //yield EmailField::new('email');
        yield TextEditorField::new('text')
            ->hideOnIndex()
        ;
        yield IdField::new('statusId');
        yield TextField::new('photoFilename')
                ->onlyOnIndex()
        ;

        $publishDate = DateTimeField::new('publishDate')->setFormTypeOptions([
            'html5' => true,
            'years' => range(date('Y'), date('Y') + 5),
            'widget' => 'single_text',
        ]);

        if (Crud::PAGE_EDIT === $pageName) {
            yield $publishDate->setFormTypeOption('disabled', true);
        } else {
            yield $publishDate;
        }
    }
}