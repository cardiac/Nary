Nary
====

Calculates and prints various number systems in a simplistic manner.

Configuration
-------------
```
    TOP: the top end system.
    BOTTOM: the bottom end system.
    COUNT: the max count.
    COMPARE_RANGE: whether or not to call range() or deuce() (convenience)
```

Convenience
-----------
One convenience definition is included:
```
	COMPARE_RANGE
```
Two convenience methods are included:
```
	Nary::range()
	Nary::deuce()
```
These should be removed from the actual class if you intend to use this algorithm in a non-trivial manner.
