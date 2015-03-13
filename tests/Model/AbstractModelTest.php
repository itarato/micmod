<?php
/**
 * @file
 */

class AbstractModelTest extends PHPUnit_Framework_TestCase {

  /**
   * @var PHPUnit_Framework_MockObject_MockObject
   */
  private $insertQueryMock;

  /**
   * @var PHPUnit_Framework_MockObject_MockObject
   */
  private $selectQueryMock;

  /**
   * @var PHPUnit_Framework_MockObject_MockObject
   */
  private $deleteQueryMock;

  /**
   * @var PHPUnit_Framework_MockObject_MockObject
   */
  private $updateQueryMock;

  /**
   * @var PHPUnit_Framework_MockObject_MockObject
   */
  private $queryFactoryMock;

  /**
   * @var \Micmod\Model\InjectableStorageModel
   */
  private $model;

  public function setUp() {
    parent::setUp();

    $this->insertQueryMock = $this->getMock('Micmod\Storage\InsertQueryEngine');
    $this->selectQueryMock = $this->getMock('Micmod\Storage\SelectQueryEngine');
    $this->updateQueryMock = $this->getMock('Micmod\Storage\UpdateQueryEngine');
    $this->deleteQueryMock = $this->getMock('Micmod\Storage\DeleteQueryEngine');

    $this->queryFactoryMock = $this->getMock('Micmod\Storage\StorageEngineFactory');
    $this->queryFactoryMock
      ->expects($this->any())
      ->method('getInsertQuery')
      ->willReturn($this->insertQueryMock);
    $this->queryFactoryMock
      ->expects($this->any())
      ->method('getSelectQuery')
      ->willReturn($this->selectQueryMock);
    $this->queryFactoryMock
      ->expects($this->any())
      ->method('getUpdateQuery')
      ->willReturn($this->updateQueryMock);
    $this->queryFactoryMock
      ->expects($this->any())
      ->method('getDeleteQuery')
      ->willReturn($this->deleteQueryMock);

    $this->model = new FoobarAnnotation($this->queryFactoryMock);
  }

  public function testExceptionWhenTableNameIsMissing() {
    $this->setExpectedException('Micmod\Exception\ModelException');

    $model = new NoTableFoobarAnnotations($this->queryFactoryMock);
    $model->id = 1;
    $model->foo = 'bar';
    $model->save();
  }

  public function testMissingPKOnUpdate() {
    $this->setExpectedException('Micmod\Exception\ModelException');

    $model = new NoPKFoobarAnnotations($this->queryFactoryMock);
    $model->id = 1;
    $model->foo = 'bar';
    $model->update();
  }

  public function testMissingPKOnDelete() {
    $this->setExpectedException('Micmod\Exception\ModelException');

    $model = new NoPKFoobarAnnotations($this->queryFactoryMock);
    $model->id = 1;
    $model->foo = 'bar';
    $model->delete();
  }

  public function testUpdateFailsWithoutPK() {
    $this->setExpectedException('Micmod\Exception\ModelException');
    $this->model->foo = 'bar';
    $this->model->update();
  }

  public function testSave() {
    $this->insertQueryMock->expects($this->once())->method('setTable')->with('foobar');
    $this->insertQueryMock->expects($this->once())->method('execute');

    $this->model->id = 1;
    $this->model->foo = 1;
    $this->model->save();
  }

  public function testLoad() {
    $this->selectQueryMock->expects($this->once())->method('setTable');
    $this->selectQueryMock->expects($this->once())->method('setCondition');
    $this->selectQueryMock
      ->expects($this->once())
      ->method('execute')
      ->willReturn((object) array(
        'idcol' => 2,
        'foocol' => 'bar',
      ));

    $this->model->id = 2;

    $this->assertNull($this->model->foo);

    $this->model->load();

    $this->assertEquals($this->model->id, 2);
    $this->assertEquals($this->model->foo, 'bar');
  }

  public function testUpdate() {
    $this->updateQueryMock->expects($this->once())->method('setTable');
    $this->updateQueryMock->expects($this->once())->method('setFieldValue');
    $this->updateQueryMock->expects($this->once())->method('setCondition');
    $this->updateQueryMock->expects($this->once())->method('execute');

    $this->model->id = 1;
    $this->model->foo = 'bar';

    $this->model->update();
  }

  public function testDelete() {
    $this->deleteQueryMock->expects($this->once())->method('setTable');
    $this->deleteQueryMock->expects($this->once())->method('setCondition');
    $this->deleteQueryMock->expects($this->once())->method('execute');

    $this->model->id = 1;
    $this->model->delete();
  }

}
