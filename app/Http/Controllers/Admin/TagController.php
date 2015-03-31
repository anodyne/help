<?php namespace Help\Http\Controllers\Admin;

use Str,
	Input,
	TagRepositoryInterface;
use Help\Events,
	Help\Http\Requests,
	Help\Http\Controllers\Controller;

class TagController extends Controller {

	protected $repo;

	public function __construct(TagRepositoryInterface $repo)
	{
		parent::__construct();

		$this->repo = $repo;
	}

	public function index()
	{
		// Get all the tags
		$tags = $this->repo->all();

		return view('pages.admin.tags.index', compact('tags'));
	}

	public function create()
	{
		return view('pages.admin.tags.create');
	}

	public function store(Requests\CreateTagRequest $request)
	{
		// Create the tag
		$tag = $this->repo->create(Input::all());

		// Fire the event
		event(new Events\TagWasCreated($tag));

		// Set the flash message
		flash_success("Tag was created.");

		return redirect()->route('admin.tag.index');
	}

	public function edit($id)
	{
		// Get the tag
		$tag = $this->repo->getById($id);

		if ($tag)
		{
			return view('pages.admin.tags.edit', compact('tag'));
		}

		return $this->errorNotFound("We couldn't find the tag you're looking for.");
	}

	public function update(Requests\EditTagRequest $request, $id)
	{
		// Update the tag
		$tag = $this->repo->update($id, Input::all());

		// Fire the event
		event(new Events\TagWasUpdated($tag));

		// Set the flash message
		flash_success("Tag was updated.");

		return redirect()->route('admin.tag.index');
	}

	public function remove($id)
	{
		// Grab the tag we're removing
		$tag = $this->repo->getById($id);

		// Build the body based on whether we found the tag or not
		$body = ($tag)
			? view('pages.admin.tags.remove', compact('tag'))
			: alert('danger', "Tag not found.");

		return partial('modal-content', [
			'header' => "Remove Tag",
			'body' => $body,
			'footer' => false,
		]);
	}

	public function destroy($id)
	{
		// Remove the tag
		$this->repo->delete($id);

		// Set the flash message
		flash_success("Tag was removed.");

		return redirect()->route('admin.tag.index');
	}

	public function setSlug()
	{
		return json_encode(['slug' => Str::slug(Input::get('value'))]);
	}

}
