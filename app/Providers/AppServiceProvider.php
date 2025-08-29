<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::preventLazyLoading();
        
        Model::handleLazyLoadingViolationUsing(function (Model $model, string $relation) {
            $modelClass = get_class($model);
            $modelId = $model->getKey();
            
            $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10);
            $caller = $this->findRelevantCaller($trace);
            
            Log::error('Lazy loading detected', [
                'model' => $modelClass,
                'model_id' => $modelId,
                'relation' => $relation,
                'file' => $caller['file'] ?? 'unknown',
                'line' => $caller['line'] ?? 'unknown',
                'url' => request()->fullUrl(),
                'method' => request()->method(),
            ]);
        });
    }

    private function findRelevantCaller(array $trace): array
    {
        foreach ($trace as $frame) {
            if (isset($frame['file']) && 
                !str_contains($frame['file'], 'vendor/') &&
                !str_contains($frame['file'], 'AppServiceProvider.php')) {
                return $frame;
            }
        }
        
        return $trace[0] ?? [];
    }
}
