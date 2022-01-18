<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGithubWebhooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_webhooks', function (Blueprint $table) {
            $table->id();
            $table->string('sender_login');
            $table->text('sender_avatar_url');
            $table->text('message');
            $table->string('timestamp');
            $table->string('repo_name');
            $table->string('commit_url');
            $table->string('after');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('github_webhooks');
    }
}
