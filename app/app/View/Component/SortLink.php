<?php

namespace App\View\Component;

use App\Utils\SortQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Class SortLink
 */
class SortLink extends Component
{
    /**
     * @param string  $column
     * @param string  $title
     * @param Request $request
     */
    public function __construct(
        private readonly string $column,
        private readonly string $title,
        private readonly Request $request
    ) {}

    /**
     * @return View
     */
    public function render(): View
    {
        $sorts = SortQuery::parse($this->request->input('sort'));
        $sorts = SortQuery::invert($sorts, $this-> column);
        $direction = $sorts[$this->column];
        $query = $this->request->query();
        $query['sort'] = SortQuery::build($sorts);
        $url = url()->query($this->request->path(), $query);

        return view('components.sort-link', [
            'title' => $this->title,
            'direction' => $direction,
            'url' => $url,
        ]);
    }
}
