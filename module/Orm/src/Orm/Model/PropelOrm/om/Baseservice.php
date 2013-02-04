<?php

namespace Orm\Model\PropelOrm\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Orm\Model\PropelOrm\category;
use Orm\Model\PropelOrm\categoryQuery;
use Orm\Model\PropelOrm\service;
use Orm\Model\PropelOrm\serviceDetail;
use Orm\Model\PropelOrm\serviceDetailQuery;
use Orm\Model\PropelOrm\servicePeer;
use Orm\Model\PropelOrm\serviceQuery;

/**
 * Base class that represents a row from the 'service' table.
 *
 *
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class Baseservice extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Orm\\Model\\PropelOrm\\servicePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        servicePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the fk_category_id field.
     * @var        int
     */
    protected $fk_category_id;

    /**
     * The value for the pos field.
     * @var        int
     */
    protected $pos;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

    /**
     * @var        category
     */
    protected $acategory;

    /**
     * @var        PropelObjectCollection|serviceDetail[] Collection to store aggregation of serviceDetail objects.
     */
    protected $collserviceDetails;
    protected $collserviceDetailsPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $serviceDetailsScheduledForDeletion = null;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see        __construct()
     */
    public function applyDefaultValues()
    {
        $this->active = true;
    }

    /**
     * Initializes internal state of Baseservice object.
     * @see        applyDefaults()
     */
    public function __construct()
    {
        parent::__construct();
        $this->applyDefaultValues();
    }

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [fk_category_id] column value.
     *
     * @return int
     */
    public function getFkCategoryId()
    {
        return $this->fk_category_id;
    }

    /**
     * Get the [pos] column value.
     *
     * @return int
     */
    public function getPos()
    {
        return $this->pos;
    }

    /**
     * Get the [active] column value.
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return service The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = servicePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fk_category_id] column.
     *
     * @param int $v new value
     * @return service The current object (for fluent API support)
     */
    public function setFkCategoryId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->fk_category_id !== $v) {
            $this->fk_category_id = $v;
            $this->modifiedColumns[] = servicePeer::FK_CATEGORY_ID;
        }

        if ($this->acategory !== null && $this->acategory->getId() !== $v) {
            $this->acategory = null;
        }


        return $this;
    } // setFkCategoryId()

    /**
     * Set the value of [pos] column.
     *
     * @param int $v new value
     * @return service The current object (for fluent API support)
     */
    public function setPos($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pos !== $v) {
            $this->pos = $v;
            $this->modifiedColumns[] = servicePeer::POS;
        }


        return $this;
    } // setPos()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return service The current object (for fluent API support)
     */
    public function setActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->active !== $v) {
            $this->active = $v;
            $this->modifiedColumns[] = servicePeer::ACTIVE;
        }


        return $this;
    } // setActive()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->active !== true) {
                return false;
            }

        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->fk_category_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->pos = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->active = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 4; // 4 = servicePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating service object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->acategory !== null && $this->fk_category_id !== $this->acategory->getId()) {
            $this->acategory = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(servicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = servicePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->acategory = null;
            $this->collserviceDetails = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(servicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = serviceQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(servicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                servicePeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->acategory !== null) {
                if ($this->acategory->isModified() || $this->acategory->isNew()) {
                    $affectedRows += $this->acategory->save($con);
                }
                $this->setcategory($this->acategory);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->serviceDetailsScheduledForDeletion !== null) {
                if (!$this->serviceDetailsScheduledForDeletion->isEmpty()) {
                    serviceDetailQuery::create()
                        ->filterByPrimaryKeys($this->serviceDetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->serviceDetailsScheduledForDeletion = null;
                }
            }

            if ($this->collserviceDetails !== null) {
                foreach ($this->collserviceDetails as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = servicePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . servicePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(servicePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(servicePeer::FK_CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`FK_CATEGORY_ID`';
        }
        if ($this->isColumnModified(servicePeer::POS)) {
            $modifiedColumns[':p' . $index++]  = '`POS`';
        }
        if ($this->isColumnModified(servicePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`ACTIVE`';
        }

        $sql = sprintf(
            'INSERT INTO `service` (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case '`ID`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`FK_CATEGORY_ID`':
                        $stmt->bindValue($identifier, $this->fk_category_id, PDO::PARAM_INT);
                        break;
                    case '`POS`':
                        $stmt->bindValue($identifier, $this->pos, PDO::PARAM_INT);
                        break;
                    case '`ACTIVE`':
                        $stmt->bindValue($identifier, (int) $this->active, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        } else {
            $this->validationFailures = $res;

            return false;
        }
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->acategory !== null) {
                if (!$this->acategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->acategory->getValidationFailures());
                }
            }


            if (($retval = servicePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collserviceDetails !== null) {
                    foreach ($this->collserviceDetails as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = servicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getFkCategoryId();
                break;
            case 2:
                return $this->getPos();
                break;
            case 3:
                return $this->getActive();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['service'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['service'][$this->getPrimaryKey()] = true;
        $keys = servicePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFkCategoryId(),
            $keys[2] => $this->getPos(),
            $keys[3] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->acategory) {
                $result['category'] = $this->acategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collserviceDetails) {
                $result['serviceDetails'] = $this->collserviceDetails->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = servicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setFkCategoryId($value);
                break;
            case 2:
                $this->setPos($value);
                break;
            case 3:
                $this->setActive($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = servicePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFkCategoryId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setPos($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setActive($arr[$keys[3]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(servicePeer::DATABASE_NAME);

        if ($this->isColumnModified(servicePeer::ID)) $criteria->add(servicePeer::ID, $this->id);
        if ($this->isColumnModified(servicePeer::FK_CATEGORY_ID)) $criteria->add(servicePeer::FK_CATEGORY_ID, $this->fk_category_id);
        if ($this->isColumnModified(servicePeer::POS)) $criteria->add(servicePeer::POS, $this->pos);
        if ($this->isColumnModified(servicePeer::ACTIVE)) $criteria->add(servicePeer::ACTIVE, $this->active);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(servicePeer::DATABASE_NAME);
        $criteria->add(servicePeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of service (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFkCategoryId($this->getFkCategoryId());
        $copyObj->setPos($this->getPos());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getserviceDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addserviceDetail($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return service Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return servicePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new servicePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a category object.
     *
     * @param             category $v
     * @return service The current object (for fluent API support)
     * @throws PropelException
     */
    public function setcategory(category $v = null)
    {
        if ($v === null) {
            $this->setFkCategoryId(NULL);
        } else {
            $this->setFkCategoryId($v->getId());
        }

        $this->acategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the category object, it will not be re-added.
        if ($v !== null) {
            $v->addservice($this);
        }


        return $this;
    }


    /**
     * Get the associated category object
     *
     * @param PropelPDO $con Optional Connection object.
     * @return category The associated category object.
     * @throws PropelException
     */
    public function getcategory(PropelPDO $con = null)
    {
        if ($this->acategory === null && ($this->fk_category_id !== null)) {
            $this->acategory = categoryQuery::create()->findPk($this->fk_category_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->acategory->addservices($this);
             */
        }

        return $this->acategory;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('serviceDetail' == $relationName) {
            $this->initserviceDetails();
        }
    }

    /**
     * Clears out the collserviceDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addserviceDetails()
     */
    public function clearserviceDetails()
    {
        $this->collserviceDetails = null; // important to set this to null since that means it is uninitialized
        $this->collserviceDetailsPartial = null;
    }

    /**
     * reset is the collserviceDetails collection loaded partially
     *
     * @return void
     */
    public function resetPartialserviceDetails($v = true)
    {
        $this->collserviceDetailsPartial = $v;
    }

    /**
     * Initializes the collserviceDetails collection.
     *
     * By default this just sets the collserviceDetails collection to an empty array (like clearcollserviceDetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initserviceDetails($overrideExisting = true)
    {
        if (null !== $this->collserviceDetails && !$overrideExisting) {
            return;
        }
        $this->collserviceDetails = new PropelObjectCollection();
        $this->collserviceDetails->setModel('serviceDetail');
    }

    /**
     * Gets an array of serviceDetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this service is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|serviceDetail[] List of serviceDetail objects
     * @throws PropelException
     */
    public function getserviceDetails($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collserviceDetailsPartial && !$this->isNew();
        if (null === $this->collserviceDetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collserviceDetails) {
                // return empty collection
                $this->initserviceDetails();
            } else {
                $collserviceDetails = serviceDetailQuery::create(null, $criteria)
                    ->filterByservice($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collserviceDetailsPartial && count($collserviceDetails)) {
                      $this->initserviceDetails(false);

                      foreach($collserviceDetails as $obj) {
                        if (false == $this->collserviceDetails->contains($obj)) {
                          $this->collserviceDetails->append($obj);
                        }
                      }

                      $this->collserviceDetailsPartial = true;
                    }

                    return $collserviceDetails;
                }

                if($partial && $this->collserviceDetails) {
                    foreach($this->collserviceDetails as $obj) {
                        if($obj->isNew()) {
                            $collserviceDetails[] = $obj;
                        }
                    }
                }

                $this->collserviceDetails = $collserviceDetails;
                $this->collserviceDetailsPartial = false;
            }
        }

        return $this->collserviceDetails;
    }

    /**
     * Sets a collection of serviceDetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $serviceDetails A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setserviceDetails(PropelCollection $serviceDetails, PropelPDO $con = null)
    {
        $this->serviceDetailsScheduledForDeletion = $this->getserviceDetails(new Criteria(), $con)->diff($serviceDetails);

        foreach ($this->serviceDetailsScheduledForDeletion as $serviceDetailRemoved) {
            $serviceDetailRemoved->setservice(null);
        }

        $this->collserviceDetails = null;
        foreach ($serviceDetails as $serviceDetail) {
            $this->addserviceDetail($serviceDetail);
        }

        $this->collserviceDetails = $serviceDetails;
        $this->collserviceDetailsPartial = false;
    }

    /**
     * Returns the number of related serviceDetail objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related serviceDetail objects.
     * @throws PropelException
     */
    public function countserviceDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collserviceDetailsPartial && !$this->isNew();
        if (null === $this->collserviceDetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collserviceDetails) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getserviceDetails());
                }
                $query = serviceDetailQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterByservice($this)
                    ->count($con);
            }
        } else {
            return count($this->collserviceDetails);
        }
    }

    /**
     * Method called to associate a serviceDetail object to this object
     * through the serviceDetail foreign key attribute.
     *
     * @param    serviceDetail $l serviceDetail
     * @return service The current object (for fluent API support)
     */
    public function addserviceDetail(serviceDetail $l)
    {
        if ($this->collserviceDetails === null) {
            $this->initserviceDetails();
            $this->collserviceDetailsPartial = true;
        }
        if (!$this->collserviceDetails->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddserviceDetail($l);
        }

        return $this;
    }

    /**
     * @param	serviceDetail $serviceDetail The serviceDetail object to add.
     */
    protected function doAddserviceDetail($serviceDetail)
    {
        $this->collserviceDetails[]= $serviceDetail;
        $serviceDetail->setservice($this);
    }

    /**
     * @param	serviceDetail $serviceDetail The serviceDetail object to remove.
     */
    public function removeserviceDetail($serviceDetail)
    {
        if ($this->getserviceDetails()->contains($serviceDetail)) {
            $this->collserviceDetails->remove($this->collserviceDetails->search($serviceDetail));
            if (null === $this->serviceDetailsScheduledForDeletion) {
                $this->serviceDetailsScheduledForDeletion = clone $this->collserviceDetails;
                $this->serviceDetailsScheduledForDeletion->clear();
            }
            $this->serviceDetailsScheduledForDeletion[]= $serviceDetail;
            $serviceDetail->setservice(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this service is new, it will return
     * an empty collection; or if this service has previously
     * been saved, it will retrieve related serviceDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in service.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|serviceDetail[] List of serviceDetail objects
     */
    public function getserviceDetailsJoinlanguage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = serviceDetailQuery::create(null, $criteria);
        $query->joinWith('language', $join_behavior);

        return $this->getserviceDetails($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->fk_category_id = null;
        $this->pos = null;
        $this->active = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
            if ($this->collserviceDetails) {
                foreach ($this->collserviceDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collserviceDetails instanceof PropelCollection) {
            $this->collserviceDetails->clearIterator();
        }
        $this->collserviceDetails = null;
        $this->acategory = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(servicePeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}
