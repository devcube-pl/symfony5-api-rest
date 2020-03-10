<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Entity\Book;
use App\Form\BookType;

/**
 * @Route("/api")
 */
class BookController extends AbstractFOSRestController
{
	/**
	 * @Route("/books", name="get_books", methods="GET")
     */
    public function getBooksAction(): array
    {
        $em = $this->getDoctrine()->getManager();
        $books = $em->getRepository(Book::class)->findAll();

        if (!$books) {
            throw new HttpException(400, "Invalid data");
        }

        return $books;
    }

	/**
	 * @Route("/books/{id}", name="get_book", methods="GET")
     */
    public function getBookAction(int $id): ?Book
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Book::class)->find($id);

        if (!$book) {
            throw new HttpException(400, "Invalid data");
        }

        return $book;
	}

	/**
	 * @Route("/book/new", name="post_book", methods="POST")
     */
    public function postBookAction(Request $request): ?Book
    {
        $book = new Book();
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $book;
        }

        throw new HttpException(400, "Invalid data");
    }

	/**
	 * @Route("/books/edit/{id}", name="put_book", methods="PUT")
	 */
    public function putBookAction(Request $request, int $id): ?Book
    {
        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Book::class)->find($id);
        $form = $this->createForm(BookType::class, $book, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($book);
            $em->flush();

            return $book;
        }

        throw new HttpException(400, "Invalid data");
    }

	/**
	 * @Route("/books/remove/{id}", name="delete_book", methods="DELETE")
	 */
    public function deleteBookAction(int $id): ?Book
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        $em = $this->getDoctrine()->getManager();
        $book = $em->getRepository(Book::class)->find($id);
        $em->remove($book);
        $em->flush();

        return $book;
    }
}

