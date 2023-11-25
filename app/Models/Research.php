<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Searchable;

class Research extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'researches';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'author',
        'adviser',
        'keyword',
        'pdf_path',
        'abstract',
        'department_id',
        'published',
        'date_submitted',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'published' => 'boolean',
        'date_submitted' => 'date',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    #[SearchUsingFullText(['abstract'])]
    public function toSearchableArray()
    {
        return [
            'title' => '',
            'author' => '',
            'adviser' => '',
            'keyword' => '',
            'abstract' => '',
            'departments.name' => '',
        ];
    }

    public function formattedAbstract()
    {
        return Str::words(strip_tags($this->abstract), 100);
    }

    public function formattedDate()
    {
        return $this->date_submitted->format('F j, Y');
    }
}
