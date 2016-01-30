<?php
namespace MyApp\Controllers;
use MyApp\Models\Comments;

/**
 * Class MainController
 * @package MyApp\Controllers
 */
class MainController extends Controller
{
    /**
     * MainController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Just static page with loaded template
     */
    public function index()
    {
    }

    /**
     * Page with comments list and form to add new one
     */
    public function comments()
    {
        $commentsModel = new Comments();
        $this->set('comments', $commentsModel->getCommentsList());
    }

    /**
     * Add comment and redirect to comments list page
     */
    public function add_comment()
    {
        // prevent of render template
        $this->render = false;

        $post = $this->f3->get('POST');
        $commentsModel = new Comments();
        $commentsModel->saveNewComment($post['author'], $post['content'], (new \Session())->ip());

        $this->f3->reroute('/comments');

    }
}