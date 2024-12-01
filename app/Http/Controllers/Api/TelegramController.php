<?php

namespace App\Http\Controllers\Api;

use App\Models\Solution;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TelegramController
{
    public function syncTelegram(Request $request): JsonResponse
    {
        $request->validate([
            'telegram_id' => 'required|string',
            'telegram_username' => 'required|string',
            'secret_key' => 'required|string',
        ]);

        if ($request->secret_key !== env('TELEGRAM_SECRET_KEY')) {
            return response()->json(['message' => 'error'], 403);
        }

        $success = (bool) User::query()
            ->where('telegram_username', $request->post('telegram_username'))
            ->update([
                'telegram_id' => $request->post('telegram_id'),
            ]);

        if ($success) {
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'error'], 404);
        }
    }

    public function sendMessageForAll(string $message)
    {
        $users = User::query()
            ->whereNotNull('telegram_id')
            ->get();

        foreach ($users as $user) {
            $this->sendMessage($user->telegram_id, $message);
        }
    }

    public function sendMessage(string $telegramId, string $message)
    {
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage',
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => $telegramId,
                    'text' => $message,
                ),
            )
        );
        curl_exec($ch);
    }

    public function solutionVerified(Solution $solution)
    {
        $parent = $solution->student->parentUser;
        if ($parent?->telegram_id !== null) {

            if ($solution->mark === null) {
                $this->sendMessage(
                    $parent->telegram_id,
                    "Преподаватель оставил комментарий к заданию {$solution->exercise_id} вашего ребенка: {$solution->comment}"
                );
                return;
            }
            $this->sendMessage(
                $parent->telegram_id,
                "Ваш ребенок получил оценку {$solution->mark} за задание {$solution->exercise_id}"
            );
        }
    }
}
