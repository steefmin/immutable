# Immutable

PHP library to easily implement immutable objects

---

```php
use SteefMin\Immutable\Immutable;

/**
 * @method self withId(int $id) 
 */
final class DTO 
{
    use Immutable;
    
    public function __construct(
        private readonly int $id,
        private readonly string $value,
    ){
    }
    
    public function id(): int
    {
        return $this->id;
    }
} 

$original = new DTO(1, 'one');

$updated = $original->with('id', 2);
// or 
$updated = $original->withId(2);

echo $original->id(); // 1
echo $updated->id(); // 2
```
