## List Methods
* list.append(elem) -- adds a single element to the end of the list. Common error: does not return the new list, just modifies the original.
* list.insert(index, elem) -- inserts the element at the given index, shifting elements to the right.
* list.extend(list2) adds the elements in list2 to the end of the list. Using + or += on a list is similar to using extend().
* list.index(elem) -- searches for the given element from the start of the list and returns its index. Throws a ValueError if the element does not appear (use "in" to check without a ValueError).
* list.remove(elem) -- searches for the first instance of the given element and removes it (throws ValueError if not present)
* list.sort() -- sorts the list in place (does not return it). (The sorted() function shown below is preferred.)
* list.reverse() -- reverses the list in place (does not return it)
* list.pop(index) -- removes and returns the element at the given index. Returns the rightmost element if index is omitted (roughly the opposite of append()).

## Dictionary Methods
* d.fromkeys() - Create a new dictonary with keys from seq and values set to value.
* d.get(key, default=None) - For any key, returns value or default if key not in dictonary
* d.has_key(key) - Removed, use the in operation instead.
* d.items() - Returns a list of d.s (key, value) tuple pairs
* d.keys() - Returns list of dictonary d's keys
* d.setdefault(key, default = None) - Similar to get(), but will set d.key] = default if key is not already in dict
* d.update(d2) - Adds dictonary d2's key-values pairs to dict
* d.values() - Returns list of dictonary d's values
* d.clear() - Removes all elements of dictonary d
### Note:
* A shallow copy constructs a new compound object and then (to the extent possible) inserts references into it to the objects found in the original.
* A deep copy constructs a new compound object and then, recursively, inserts copies into it of the objects found in the original.
