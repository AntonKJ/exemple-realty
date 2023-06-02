<?php

namespace App\Controller\Admin;

use App\Entity\Works;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class WorksCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Works::class;
    }

    /**/
    public function configureFields(string $pageName): iterable
    {

        yield TextField::new('author');

        yield TextEditorField::new('work_text')
            ->hideOnIndex()
        ;

        $publishDate = DateTimeField::new('add_date')->setFormTypeOptions([
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
