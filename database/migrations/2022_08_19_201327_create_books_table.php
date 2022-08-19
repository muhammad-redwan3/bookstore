<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn')->nullable();
            $table->text('description')->nullable();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->OnDelete('set null');

            $table->foreignId('publisher_id')
                ->constrained('publishers')
                ->cascadeOnUpdate()
                ->OnDelete('set null');


            $table->unsignedBigInteger('publish_year')->nullable();
            $table->unsignedBigInteger('number_of_pages');
            $table->unsignedBigInteger('number_of_copies');
            $table->decimal('price',8,2);
            $table->string('cover_image');
            $table->timestamps();
        });

        Schema::create('book_author', function (Blueprint $table) {
            $table->increments('id');

            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('author_id')
                ->constrained('authors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('book_user', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('book_id')
                ->constrained('books')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();



            $table->unsignedBigInteger('number_of_copies')->default(1);
            $table->boolean('bought')->default(false);
            $table->decimal('price',8,2);
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
        Schema::dropIfExists('books');
        Schema::dropIfExists('book_author');
        Schema::dropIfExists('book_user');
    }
};
