<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthApiHeaders;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class GetBranches
{
    use AsAction;

    /**
     * @return Branch[]
     */
    public function handle(SourceCodeAccount $account, RepositoryName $repository)
    {
        $headers = GetAuthApiHeaders::run($account);
        $response = Http::withHeaders($headers)->get('https://api.bitbucket.org/2.0/' . $repository->workspace . '/' . $repository->name. '/refs/branches');

        $content = json_decode($response->body(), true);
        $branches = [];
        $this->getAllBranches($content, $branches, $headers);

        return collect($branches)
            ->mapInto(Branch::class)
            ->toArray();
    }

    private function getAllBranches($content, &$branches, $headers)
    {
        foreach($content['values'] as $value)
        {
            $branches[] = [
                'name' => $value['name'],
            ];
        }

        if(isset($content['next']) && $content['next'] != ''){
            $content = Http::withHeaders($headers)->get($content['next']);
            $this->getAllBranches($content, $branches, $headers);
        }
    }
}
