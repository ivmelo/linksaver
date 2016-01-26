<?php

namespace App\Http\Controllers;

use App\Link;
use Auth;
use Illuminate\Support\Facades\Validator;
use Request;

class LinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Get all links ordered by creation date descending and paginate.
        $links = Link::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);

        return view('links.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // Show form to add a new link.
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        // Validate the url format and uniquiness.
        $validator = Validator::make(Request::all(),
            ['url' => 'required|url|unique:links']
        );

        // If doesn't validate, redirect to the previous page
        // With errors and input for correction
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create an instance of the link model
        $link = new Link();

        $link->url = Request::get('url');

        // Gets page title from the website
        $page_title = Request::get('title');

        // If can't recover the page title, show user a form to
        // Manually insert a page title
        if (empty($page_title)) {
            $page_title = $this->getPageTitleByUrl(Request::get('url'));
            if (empty($page_title)) {
                return redirect('link/create')->withInput()->withErrors($validator)->with('warning_message', 'You must manually add a title to this url!');
            }
        }

        // Everything is allright, put page title
        // in the link object
        $link->title = $page_title;

        $link->user()->associate(Auth::user());

        // Save everything in the database
        $link->save();

        // Return to index page and show message
        return redirect('link')->with('flash_message', 'Link added with success!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // Get a link by the id
        $link = Link::find($id);

        // If there is no link or if the link doesn't
        // belong to the user who is logged in
        if (!$link || $link->user->id !== Auth::user()->id) {
            // Display a 404 page
            abort(404);
        }

        // Call view to display link info
        return view('links.show', compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // Get a link
        $link = Link::find($id);

        // If there is no link or if the link doesn't
        // belong to the user who is logged in
        if (!$link || $link->user->id !== Auth::user()->id) {
            // Display a 404 page
            abort(404);
        }

        // Call view to show link info for edition
        return view('links.edit', compact('link'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        // Define validation rules for link and title
        $validator = Validator::make(Request::all(), [
            'url'   => 'required|url',
            'title' => 'required',
            ]
        );

        // If not validated
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create an instance of the link and save it to the database
        $link = Link::find($id);

        // If there is no link or if the link doesn't
        // belong to the user who is logged in
        if (!$link || $link->user->id !== Auth::user()->id) {
            // Display a 404 page
            abort(404);
        }

        $link->url = Request::get('url');
        // Gets page title from
        $link->title = Request::get('title');

        // Save the porra toda
        $link->save();

        return redirect('link')->with('flash_message', 'Your link was sucessfully modified!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        //
        $link = Link::find($id);

        // If there is no link or if the link doesn't
        // belong to the user who is logged in
        if (!$link || $link->user->id !== Auth::user()->id) {
            // Display a 404 page
            abort(404);
        }

        $link->delete();

        return redirect('link')->with('flash_message', 'Your link was sucessfully deleted from your collection!');
    }

    /**
     * Gets an URL and returns the title of the page
     * correspondent to that url.
     *
     * @param string $url
     *
     * @return string
     */
    private function getPageTitleByUrl($url)
    {
        $str = file_get_contents($url);
        if (strlen($str) > 0) {
            preg_match("/\<title\>(.*)\<\/title\>/", $str, $title);
            if (!empty($title) && strlen($title[1]) > 0) {
                return $title[1];
            } else {
                return;
            }
        } else {
            return;
        }
    }
}
