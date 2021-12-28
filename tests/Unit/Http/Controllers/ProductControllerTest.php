<?php

namespace Tests\Unit\Http\Controllers;

use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\ColorRepository;
use App\Contracts\Repositories\MemoryRepository;
use App\Contracts\Repositories\ProductAttributeRepository;
use App\Contracts\Repositories\ProductImageRepository;
use App\Contracts\Repositories\ProductRepository;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Category;
use App\Models\Color;
use App\Models\Memory;
use App\Models\Product;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\ProductAttribute;
use App\Models\User;
use Tests\TestCase;
use Mockery as m;
use Illuminate\Support\Facades\Config;
use DB;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductControllerTest extends TestCase
{
    protected $productController;

    protected $productRepository;

    protected $categoryRepository;

    protected $colorRepository;

    protected $memoryRepository;

    protected $productAttributeRepository;

    protected $productImageRepository;

    public function setUp(): void
    {
        parent::setUp();
        $this->productRepository = m::mock(ProductRepository::class);
        $this->categoryRepository = m::mock(CategoryRepository::class);
        $this->colorRepository = m::mock(ColorRepository::class);
        $this->memoryRepository = m::mock(MemoryRepository::class);
        $this->productAttributeRepository = m::mock(ProductAttributeRepository::class);
        $this->productImageRepository = m::mock(ProductImageRepository::class);

        $this->productController = new ProductController(
            $this->productRepository,
            $this->categoryRepository,
            $this->colorRepository,
            $this->memoryRepository,
            $this->productAttributeRepository,
            $this->productImageRepository,
        );
    }

    public function tearDown(): void
    {
        parent::tearDown();
        m::close();
        unset($this->productController);
    }


    public function testIndex()
    {
        Config::set('const.block', 1);

        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $this->productRepository->shouldReceive('getAllProduct')->andReturn($product);
        $response = $this->productController->index();
        $this->assertEquals('admin.products.index', $response->getName());
    }

    public function testCreate()
    {
        $category = m::mock(Category::class)->makePartial();
        $category->id = 1;

        $color = m::mock(Color::class)->makePartial();
        $color->id = 1;

        $memory = m::mock(Memory::class)->makePartial();
        $memory->id = 1;

        $this->categoryRepository->shouldReceive('all')->andReturn($category);
        $this->colorRepository->shouldReceive('all')->andReturn($color);
        $this->memoryRepository->shouldReceive('all')->andReturn($memory);

        $response = $this->productController->create();
        $this->assertEquals('admin.products.create', $response->getName());
    }

    public function testStoreCreateProductFalse()
    {
        DB::shouldReceive('beginTransaction');

        $request = new StoreProductRequest(
            [
            'category_id' => 1,
            'name' => 'Test',
            'content' => 'Test Content',
            'specifications' => 'Test specifications',
            'color_id' => 1,
            'memory_id' => 1,
            'price' => 111
            ]
        );

        $this->productRepository->shouldReceive('create')->andReturn(false);

        $response = $this->productController->store($request);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testStoreCreateProductSuccess()
    {
        DB::shouldReceive('beginTransaction');

        $request = new StoreProductRequest(
            [
            'category_id' => 1,
            'name' => 'Test',
            'content' => 'Test Content',
            'specifications' => 'Test specifications',
            'color_id' => [0 => 1],
            'memory_id' => [0 => 2],
            'price' => [0 => 111],
            'quantity' => [1],
            'images' => [UploadedFile::fake()->image('file.png')],
            ]
        );

        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $this->productRepository->shouldReceive('create')->andReturn($product);
        $this->productAttributeRepository->shouldReceive('create')->andReturn();
        $this->productImageRepository->shouldReceive('create')->andReturn();

        DB::shouldReceive('commit');

        $response = $this->productController->store($request);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testCreateException()
    {
        DB::shouldReceive('beginTransaction');

        $request = new StoreProductRequest(
            [
            'category_id' => 1,
            ]
        );

        $this->productRepository->shouldReceive('create')->andReturn(true);

        DB::shouldReceive('rollback');
        Log::shouldReceive('error');

        $response = $this->productController->store($request);
        $this->assertNull($response);
    }

    public function testShow()
    {
        $slug = 'test';

        $product = m::mock(Product::class)->makePartial();

        $this->productRepository->shouldReceive('getDetailProduct')->andReturn($product);
        $response = $this->productController->show($slug);
        $this->assertEquals('admin.products.details', $response->getName());
    }

    public function testEdit()
    {
        $slug = 'test';

        $category = m::mock(Category::class)->makePartial();
        $category->id = 1;

        $color = m::mock(Color::class)->makePartial();
        $color->id = 1;

        $memory = m::mock(Memory::class)->makePartial();
        $memory->id = 1;

        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $this->categoryRepository->shouldReceive('all')->andReturn($category);
        $this->colorRepository->shouldReceive('all')->andReturn($color);
        $this->memoryRepository->shouldReceive('all')->andReturn($memory);
        $this->productRepository->shouldReceive('WhereSlug->with->firstOrFail')->andReturn($product);

        $response = $this->productController->edit($slug);
        $this->assertEquals('admin.products.edit', $response->getName());
    }

    public function testUpdateFalse()
    {
        DB::shouldReceive('beginTransaction');

        $request = new UpdateProductRequest(
            [
                'category_id' => 1,
                'name' => 'test',
                'content' => 'test content',
                'specifications' => 'test specifications',
            ]
        );
        $product = m::mock(Product::class)->makePartial();
        $product->shouldReceive('update')->andReturn(false);

        $response = $this->productController->update($request, $product);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testUpdateSuccess()
    {
        DB::shouldReceive('beginTransaction');

        $request = new UpdateProductRequest(
            [
                'category_id' => 1,
                'name' => 'Test',
                'content' => 'Test Content',
                'specifications' => 'Test specifications',
                'color_id' => [0 => 1],
                'memory_id' => [0 => 2],
                'price' => [0 => 111],
                'quantity' => [1],
                'images' => [UploadedFile::fake()->image('file.png')],
            ]
        );
        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $productAttribute = m::mock(ProductAttribute::class)->makePartial();
        $productAttribute->id = 1;

        $product->shouldReceive('update')->andReturn($product);
        $product->setRelation('productAttributes', $productAttribute);
        $productAttribute->shouldReceive('pluck->toArray')->andReturn([1]);
        $product->shouldReceive('productAttributes->where->update')->andReturn(true);
        $product->shouldReceive('productImages->updateOrCreate')->andReturn(true);

        DB::shouldReceive('commit');

        $response = $this->productController->update($request, $product);
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testUpdateException()
    {
        DB::shouldReceive('beginTransaction');

        $request = new UpdateProductRequest(
            [
            'category_id' => 1,
            ]
        );

        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $product->shouldReceive('update')->andReturn($product);

        DB::shouldReceive('rollback');
        Log::shouldReceive('error');

        $response = $this->productController->update($request, $product);
        $this->assertNull($response);
    }

    public function testDestroySuccess()
    {
        DB::shouldReceive('beginTransaction');

        $id = 1;

        $product = m::mock(Product::class)->makePartial();

        $this->productRepository->shouldReceive('deleteProduct')->andReturn($product);

        DB::shouldReceive('commit');

        $response = $this->productController->destroy($id);
        $this->assertInstanceOf(RedirectResponse::class, $response);
    }

    public function testDestroyException()
    {
        DB::shouldReceive('beginTransaction');

        $id = 1;

        $this->productRepository->shouldReceive('deleteProduct')->andThrow(new Exception());

        DB::shouldReceive('rollback');
        Log::shouldReceive('error');

        $response = $this->productController->destroy($id);
        $this->assertNull($response);
    }

    public function testSearchForAdmin()
    {
        $request = new Request(
            [
            'name' => 'test',
            ]
        );

        Config::set('const.block', 1);

        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $user = m::mock(User::class)->makePartial();
        $user->id = 1;
        $user->role_id = config('const.admin');

        $this->productRepository->shouldReceive('WhereHas')
            ->with(
                'productAttributes',
                m::on(
                    function ($query) {
                        $queryMock = m::mock(Builder::class);
                        $queryMock->shouldReceive('where')->andReturnSelf();
                        $query->__invoke($queryMock);

                        return is_callable($query);
                    }
                )
            )->andReturnSelf();
        $this->productRepository->shouldReceive('orWhere->orderBy->paginate')->andReturn($product);

        Auth::shouldReceive('user')->andReturn($user);

        $response = $this->productController->search($request);
        $this->assertEquals('admin.search', $response->getName());
    }

    public function testSearchForUser()
    {
        $request = new Request(
            [
            'name' => 'test',
            ]
        );

        Config::set('const.block', 1);

        $product = m::mock(Product::class)->makePartial();
        $product->id = 1;

        $this->productRepository->shouldReceive('WhereHas')
            ->with(
                'productAttributes',
                m::on(
                    function ($query) {
                        $queryMock = m::mock(Builder::class);
                        $queryMock->shouldReceive('where')->andReturnSelf();
                        $query->__invoke($queryMock);

                        return is_callable($query);
                    }
                )
            )->andReturnSelf();
        $this->productRepository->shouldReceive('orWhere->orderBy->paginate')->andReturn($product);

        $response = $this->productController->search($request);
        $this->assertEquals('search', $response->getName());
    }
}
