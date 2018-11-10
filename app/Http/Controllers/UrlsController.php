<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UrlCreateRequest;
use App\Http\Requests\UrlUpdateRequest;
use App\Repositories\UrlRepository;
use App\Validators\UrlValidator;

/**
 * Class UrlsController.
 *
 * @package namespace App\Http\Controllers;
 */
class UrlsController extends Controller
{
    /**
     * @var UrlRepository
     */
    protected $repository;

    /**
     * @var UrlValidator
     */
    protected $validator;

    /**
     * UrlsController constructor.
     *
     * @param UrlRepository $repository
     * @param UrlValidator $validator
     */
    public function __construct(UrlRepository $repository, UrlValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $urls = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $urls,
            ]);
        }

        return view('urls.index', compact('urls'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UrlCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(UrlCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $url = $this->repository->create($request->all());

            $response = [
                'message' => 'Url created.',
                'data'    => $url->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $url = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $url,
            ]);
        }

        return view('urls.show', compact('url'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $url = $this->repository->find($id);

        return view('urls.edit', compact('url'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UrlUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(UrlUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $url = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Url updated.',
                'data'    => $url->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Url deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Url deleted.');
    }
}
