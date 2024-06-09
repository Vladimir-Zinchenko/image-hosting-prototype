<?php

namespace App\View\Component;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

/**
 * Class SortLink
 */
class SortLink extends Component
{
    public function __construct(private readonly string $column, private readonly string $title, private readonly Request $request) {}

    /**
     * @return View
     */
    public function render(): View
    {
        $sorts = explode(',', $this->request->input('sort', 'uploaded_at'));
        $url = $this->request->url();
        $sortDirection = 'asc';

        foreach ($sorts as $sortColumn) {
            $direction = Str::startsWith($sortColumn, '-') ? 'desc' : 'asc';
            $column = ltrim($sortColumn, '-');

            if ($column === $this->column) {
                $sortDirection = $direction;
            }
        }

//        $url = Ur

        return view('components.sort-link', [
            'title' => $this->title,
            'url' => $url,
        ]);
    }
}
