Micro Model Layer
=================

Micro model layer is micro-library to provide convenient CRUD operations for models. It's using annotations to mark properties as part of the storage and there is an extensible storage api to handle persistence.

At the moment a Drupal 7 storage implementation is implemented in the library.

Here a *model* should be as pure as possible. Because of annotations it can clearly separate the model properties from management props, however non strictly model elements should be moved out to different units (such as controllers).


Install
-------

Add the composer package as a dependency (package info is coming soon).


Usage - with Drupal
-------------------

First you either create a model or add the base class to an existing model. The pure 

```php
<?php

/**
 * @table micmod
 */
class ExampleModel extends \Micmod\Model\DrupalModel {

  /**
   * @column id
   * @primary-key
   */
  public $id;

  /**
   * @column name
   */
  public $name;

}
```

Create new object - instantiate the class and fill out the properties:

```php
$item = new \ExampleModel();
$item->id = 123;
$item->name = 'Jason';
$item->save();
```

Load object - instantiate the class and set the primary keys:

```php
$item = new \ExampleModel();
$item->id = 123;
$item->load();
echo $item->name;
```

Update object - load or instantiate the object, change the non primary key fields and update (non loaded ((NULL)) properties will not be set):

```php
$item = new \ExampleModel();
$item->id = 123;
$item->name = 'Richard'; 
$item->update();
```

Delete new object - set the primary keys and delete:

```php
$item = new \ExampleModel();
$item->id = 123;
$item->Delete();
```


Annotations
-----------

**Table name**:

Defines the table the model is stored in.

Tag: 'table'

Example:

```php
/**
 * @table TABLENAME
 */
```

**Column name**:

Defines the table column name the of the property. Column name and variable name can be different.

Tag: 'column'

Example:

```php
/**
 * @column COLUMN_NAME
 */
public $userName;
```

**Primary key**:

Marks a property a primary key. There has to be one primary key at least, but there can be more.

Tag: 'primary-key'

Example:
```php
/**
 * @column COLUMN_NAME
 * @primary-key
 */
public $userName;
```
