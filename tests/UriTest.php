<?php
use FastD\Http\Uri;

/**
 *
 * @author    jan huang <bboyjanhuang@gmail.com>
 * @copyright 2016
 *
 * @link      https://www.github.com/janhuang
 * @link      http://www.fast-d.cn/
 */
class UriTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testInvalidUri()
    {
        new Uri('///');
    }

    public function testPath()
    {
        $uri = new Uri('/');
        $this->assertEquals('/', $uri->getPath());
    }

    public function testRootPath()
    {
        $uri = new Uri('https://example.com');
        $this->assertEquals('/', $uri->getPath());
    }

    public function testUri()
    {
        $uri = new Uri('https://user:pass@local.example.com:3001/foo?bar=baz#quz');
        $this->assertEquals('https', $uri->getScheme());
        $this->assertEquals('user:pass', $uri->getUserInfo());
        $this->assertEquals('local.example.com', $uri->getHost());
        $this->assertEquals(3001, $uri->getPort());
        $this->assertEquals('user:pass@local.example.com:3001', $uri->getAuthority());
        $this->assertEquals('/foo', $uri->getPath());
        $this->assertEquals(['bar' => 'baz'], $uri->getQuery());
        $this->assertEquals('quz', $uri->getFragment());
    }

    public function testCanSerializeToString()
    {
        $url = 'https://user:pass@local.example.com:3001/foo?bar=baz#quz';
        $uri = new Uri($url);
        $this->assertEquals($url, (string)$uri);
    }

    public function testUriToPathInfo()
    {
        $url = '/foo?bar=baz#quz';
        $uri = new Uri($url);
        $this->assertEquals($url, (string)$uri);
        $this->assertEquals('/foo', $uri->getPath());
    }

    public function testLocalUriToPathInfo()
    {
        $url = 'http://localhost/foo/index.php/bar';
        $uri = new Uri($url);
        $this->assertEquals('/foo/index.php/bar', $uri->getPath());
    }

    public function testLocalUriToRelationPath()
    {
        $url = 'http://localhost/foo/index.php/bar';
        $uri = new Uri($url);
        $this->assertEquals('/bar', $uri->getRelationPath());
    }

    public function testUriQueryString()
    {
        $url = 'https://user:pass@local.example.com:3001/foo?bar=baz#quz';
        $uri = new Uri($url);
        $this->assertEquals([
            'bar' => 'baz',
        ], $uri->getQuery());

        $url = 'https://user:pass@local.example.com:3001/foo?bar=baz&foo=bar#quz';
        $uri = new Uri($url);
        $this->assertEquals([
            'bar' => 'baz',
            'foo' => 'bar'
        ], $uri->getQuery());
    }

    public function testDefaultPort()
    {
        $url = 'https://example/service/rest.htm';
        $uri = new Uri($url);
        echo $uri;
    }

    public function testStandardPort()
    {
        $url = 'https://example/service/rest.htm';
        $uri = new Uri($url);
        $this->assertEquals($url, (string) $uri);
    }

    public function testNonStandardPort()
    {
        $url = 'https://example:8088/service/rest.htm';
        $uri = new Uri($url);
        $this->assertEquals($url, (string) $uri);
    }
}
