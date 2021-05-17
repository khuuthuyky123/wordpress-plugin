<?php
/**
 * Tests MVC category model.
 *
 * @author Alejandro Mostajo <http://about.me/amostajo>
 * @copyright 10Quality <http://www.10quality.com>
 * @license MIT
 * @package WPMVC\MVC
 * @version 2.1.11.1
 */
class CategoryTest extends MVCTestCase
{
    /**
     * Tests model construction.
     * @group models
     */
    public function testConstruct()
    {
        $category = new Category;
        $this->assertEquals($category->to_array(), []);
    }
    /**
     * Tests model find.
     * @group models
     */
    public function testFind()
    {
        $category = Category::find(1);
        $this->assertEquals($category->term_id, 1);
        $this->assertEquals($category->name, 'Category');
    }
    /**
     * Tests model aliases.
     * @group models
     */
    public function testAliases()
    {
        $category = Category::find(1);
        $category->setAliases([
            'ID'        => 'term_id',
            'concat'    => 'func_concat_name',
        ]);
        $this->assertEquals($category->ID, 1);
        $this->assertEquals($category->concat, 'Categorycategory');
        $category->ID = 99;
        $this->assertEquals($category->ID, 99);
        $this->assertEquals($category->term_id, 99);
    }
    /**
     * Tests model meta.
     * @group models
     */
    public function testMeta()
    {
        $category = Category::find(1);
        $category->setAliases([
            'views'  => 'meta_views',
        ]);
        $this->assertNull($category->views);
        $category->views = 99;
        $this->assertEquals($category->views, 99);
        $this->assertTrue($category->has_meta('views'));
        $this->assertFalse($category->has_meta('viewed'));
        $this->assertTrue($category->save());
    }
    /**
     * Tests model casting to array.
     * @group models
     */
    public function testCastingArray()
    {
        $category = Category::find(1);
        $category->setHidden([
            'cat_ID',
            'name',
            'slug',
            'description',
            'taxonomy',
        ]);
        $this->assertEquals($category->to_array(), ['term_id' => 1]);
    }
    /**
     * Tests model casting to string / json.
     * @group models
     */
    public function testCastingString()
    {
        $category = Category::find(1);
        $category->setHidden([
            'cat_ID',
            'name',
            'description',
            'taxonomy',
        ]);
        $this->assertEquals((string)$category, '{"term_id":1,"slug":"category"}');
    }
    /**
     * Tests that missing "has_trace" does not affect the models.
     * @group models
     * @group categories
     */
    public function testTracableBackwardsCompatibility()
    {
        $category = Category::find(5000100);
        $this->assertNotNull($category);
        $this->assertInstanceOf(Category::class, $category);
    }
}