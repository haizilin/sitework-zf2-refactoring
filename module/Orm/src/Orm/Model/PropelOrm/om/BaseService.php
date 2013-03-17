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
use Orm\Model\PropelOrm\Category;
use Orm\Model\PropelOrm\CategoryQuery;
use Orm\Model\PropelOrm\Service;
use Orm\Model\PropelOrm\ServiceDetail;
use Orm\Model\PropelOrm\ServiceDetailQuery;
use Orm\Model\PropelOrm\ServicePeer;
use Orm\Model\PropelOrm\ServiceQuery;

/**
 * Base class that represents a row from the 'service' table.
 *
 *
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseService extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Orm\\Model\\PropelOrm\\ServicePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ServicePeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinite loop in deep copy
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
     * @var        Category
     */
    protected $aCategory;

    /**
     * @var        PropelObjectCollection|ServiceDetail[] Collection to store aggregation of ServiceDetail objects.
     */
    protected $collServiceDetails;
    protected $collServiceDetailsPartial;

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
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

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
     * Initializes internal state of BaseService object.
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
     * @return Service The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ServicePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fk_category_id] column.
     *
     * @param int $v new value
     * @return Service The current object (for fluent API support)
     */
    public function setFkCategoryId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->fk_category_id !== $v) {
            $this->fk_category_id = $v;
            $this->modifiedColumns[] = ServicePeer::FK_CATEGORY_ID;
        }

        if ($this->aCategory !== null && $this->aCategory->getId() !== $v) {
            $this->aCategory = null;
        }


        return $this;
    } // setFkCategoryId()

    /**
     * Set the value of [pos] column.
     *
     * @param int $v new value
     * @return Service The current object (for fluent API support)
     */
    public function setPos($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->pos !== $v) {
            $this->pos = $v;
            $this->modifiedColumns[] = ServicePeer::POS;
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
     * @return Service The current object (for fluent API support)
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
            $this->modifiedColumns[] = ServicePeer::ACTIVE;
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
     * @param int $startcol 0-based offset column which indicates which resultset column to start with.
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
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 4; // 4 = ServicePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Service object", $e);
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

        if ($this->aCategory !== null && $this->fk_category_id !== $this->aCategory->getId()) {
            $this->aCategory = null;
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
            $con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ServicePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aCategory = null;
            $this->collServiceDetails = null;

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
            $con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ServiceQuery::create()
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
            $con = Propel::getConnection(ServicePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ServicePeer::addInstanceToPool($this);
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
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCategory !== null) {
                if ($this->aCategory->isModified() || $this->aCategory->isNew()) {
                    $affectedRows += $this->aCategory->save($con);
                }
                $this->setCategory($this->aCategory);
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
                    foreach ($this->serviceDetailsScheduledForDeletion as $serviceDetail) {
                        // need to save related object because we set the relation to null
                        $serviceDetail->save($con);
                    }
                    $this->serviceDetailsScheduledForDeletion = null;
                }
            }

            if ($this->collServiceDetails !== null) {
                foreach ($this->collServiceDetails as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
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

        $this->modifiedColumns[] = ServicePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ServicePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ServicePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ServicePeer::FK_CATEGORY_ID)) {
            $modifiedColumns[':p' . $index++]  = '`fk_category_id`';
        }
        if ($this->isColumnModified(ServicePeer::POS)) {
            $modifiedColumns[':p' . $index++]  = '`pos`';
        }
        if ($this->isColumnModified(ServicePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
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
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`fk_category_id`':
                        $stmt->bindValue($identifier, $this->fk_category_id, PDO::PARAM_INT);
                        break;
                    case '`pos`':
                        $stmt->bindValue($identifier, $this->pos, PDO::PARAM_INT);
                        break;
                    case '`active`':
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
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggregated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objects otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aCategory !== null) {
                if (!$this->aCategory->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aCategory->getValidationFailures());
                }
            }


            if (($retval = ServicePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collServiceDetails !== null) {
                    foreach ($this->collServiceDetails as $referrerFK) {
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
        $pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['Service'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Service'][$this->getPrimaryKey()] = true;
        $keys = ServicePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFkCategoryId(),
            $keys[2] => $this->getPos(),
            $keys[3] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aCategory) {
                $result['Category'] = $this->aCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collServiceDetails) {
                $result['ServiceDetails'] = $this->collServiceDetails->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = ServicePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
        $keys = ServicePeer::getFieldNames($keyType);

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
        $criteria = new Criteria(ServicePeer::DATABASE_NAME);

        if ($this->isColumnModified(ServicePeer::ID)) $criteria->add(ServicePeer::ID, $this->id);
        if ($this->isColumnModified(ServicePeer::FK_CATEGORY_ID)) $criteria->add(ServicePeer::FK_CATEGORY_ID, $this->fk_category_id);
        if ($this->isColumnModified(ServicePeer::POS)) $criteria->add(ServicePeer::POS, $this->pos);
        if ($this->isColumnModified(ServicePeer::ACTIVE)) $criteria->add(ServicePeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(ServicePeer::DATABASE_NAME);
        $criteria->add(ServicePeer::ID, $this->id);

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
     * @param object $copyObj An object of Service (or compatible) type.
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

            foreach ($this->getServiceDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addServiceDetail($relObj->copy($deepCopy));
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
     * @return Service Clone of current object.
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
     * @return ServicePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ServicePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Category object.
     *
     * @param             Category $v
     * @return Service The current object (for fluent API support)
     * @throws PropelException
     */
    public function setCategory(Category $v = null)
    {
        if ($v === null) {
            $this->setFkCategoryId(NULL);
        } else {
            $this->setFkCategoryId($v->getId());
        }

        $this->aCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Category object, it will not be re-added.
        if ($v !== null) {
            $v->addService($this);
        }


        return $this;
    }


    /**
     * Get the associated Category object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Category The associated Category object.
     * @throws PropelException
     */
    public function getCategory(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aCategory === null && ($this->fk_category_id !== null) && $doQuery) {
            $this->aCategory = CategoryQuery::create()->findPk($this->fk_category_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aCategory->addServices($this);
             */
        }

        return $this->aCategory;
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
        if ('ServiceDetail' == $relationName) {
            $this->initServiceDetails();
        }
    }

    /**
     * Clears out the collServiceDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Service The current object (for fluent API support)
     * @see        addServiceDetails()
     */
    public function clearServiceDetails()
    {
        $this->collServiceDetails = null; // important to set this to null since that means it is uninitialized
        $this->collServiceDetailsPartial = null;

        return $this;
    }

    /**
     * reset is the collServiceDetails collection loaded partially
     *
     * @return void
     */
    public function resetPartialServiceDetails($v = true)
    {
        $this->collServiceDetailsPartial = $v;
    }

    /**
     * Initializes the collServiceDetails collection.
     *
     * By default this just sets the collServiceDetails collection to an empty array (like clearcollServiceDetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initServiceDetails($overrideExisting = true)
    {
        if (null !== $this->collServiceDetails && !$overrideExisting) {
            return;
        }
        $this->collServiceDetails = new PropelObjectCollection();
        $this->collServiceDetails->setModel('ServiceDetail');
    }

    /**
     * Gets an array of ServiceDetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Service is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ServiceDetail[] List of ServiceDetail objects
     * @throws PropelException
     */
    public function getServiceDetails($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collServiceDetailsPartial && !$this->isNew();
        if (null === $this->collServiceDetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collServiceDetails) {
                // return empty collection
                $this->initServiceDetails();
            } else {
                $collServiceDetails = ServiceDetailQuery::create(null, $criteria)
                    ->filterByService($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collServiceDetailsPartial && count($collServiceDetails)) {
                      $this->initServiceDetails(false);

                      foreach($collServiceDetails as $obj) {
                        if (false == $this->collServiceDetails->contains($obj)) {
                          $this->collServiceDetails->append($obj);
                        }
                      }

                      $this->collServiceDetailsPartial = true;
                    }

                    $collServiceDetails->getInternalIterator()->rewind();
                    return $collServiceDetails;
                }

                if($partial && $this->collServiceDetails) {
                    foreach($this->collServiceDetails as $obj) {
                        if($obj->isNew()) {
                            $collServiceDetails[] = $obj;
                        }
                    }
                }

                $this->collServiceDetails = $collServiceDetails;
                $this->collServiceDetailsPartial = false;
            }
        }

        return $this->collServiceDetails;
    }

    /**
     * Sets a collection of ServiceDetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $serviceDetails A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Service The current object (for fluent API support)
     */
    public function setServiceDetails(PropelCollection $serviceDetails, PropelPDO $con = null)
    {
        $serviceDetailsToDelete = $this->getServiceDetails(new Criteria(), $con)->diff($serviceDetails);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->serviceDetailsScheduledForDeletion = clone $serviceDetailsToDelete;

        foreach ($serviceDetailsToDelete as $serviceDetailRemoved) {
            $serviceDetailRemoved->setService(null);
        }

        $this->collServiceDetails = null;
        foreach ($serviceDetails as $serviceDetail) {
            $this->addServiceDetail($serviceDetail);
        }

        $this->collServiceDetails = $serviceDetails;
        $this->collServiceDetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ServiceDetail objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ServiceDetail objects.
     * @throws PropelException
     */
    public function countServiceDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collServiceDetailsPartial && !$this->isNew();
        if (null === $this->collServiceDetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collServiceDetails) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getServiceDetails());
            }
            $query = ServiceDetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByService($this)
                ->count($con);
        }

        return count($this->collServiceDetails);
    }

    /**
     * Method called to associate a ServiceDetail object to this object
     * through the ServiceDetail foreign key attribute.
     *
     * @param    ServiceDetail $l ServiceDetail
     * @return Service The current object (for fluent API support)
     */
    public function addServiceDetail(ServiceDetail $l)
    {
        if ($this->collServiceDetails === null) {
            $this->initServiceDetails();
            $this->collServiceDetailsPartial = true;
        }
        if (!in_array($l, $this->collServiceDetails->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddServiceDetail($l);
        }

        return $this;
    }

    /**
     * @param	ServiceDetail $serviceDetail The serviceDetail object to add.
     */
    protected function doAddServiceDetail($serviceDetail)
    {
        $this->collServiceDetails[]= $serviceDetail;
        $serviceDetail->setService($this);
    }

    /**
     * @param	ServiceDetail $serviceDetail The serviceDetail object to remove.
     * @return Service The current object (for fluent API support)
     */
    public function removeServiceDetail($serviceDetail)
    {
        if ($this->getServiceDetails()->contains($serviceDetail)) {
            $this->collServiceDetails->remove($this->collServiceDetails->search($serviceDetail));
            if (null === $this->serviceDetailsScheduledForDeletion) {
                $this->serviceDetailsScheduledForDeletion = clone $this->collServiceDetails;
                $this->serviceDetailsScheduledForDeletion->clear();
            }
            $this->serviceDetailsScheduledForDeletion[]= clone $serviceDetail;
            $serviceDetail->setService(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Service is new, it will return
     * an empty collection; or if this Service has previously
     * been saved, it will retrieve related ServiceDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Service.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ServiceDetail[] List of ServiceDetail objects
     */
    public function getServiceDetailsJoinLanguage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ServiceDetailQuery::create(null, $criteria);
        $query->joinWith('Language', $join_behavior);

        return $this->getServiceDetails($query, $con);
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
        $this->alreadyInClearAllReferencesDeep = false;
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
     * when using Propel in certain daemon or large-volume/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collServiceDetails) {
                foreach ($this->collServiceDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aCategory instanceof Persistent) {
              $this->aCategory->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collServiceDetails instanceof PropelCollection) {
            $this->collServiceDetails->clearIterator();
        }
        $this->collServiceDetails = null;
        $this->aCategory = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ServicePeer::DEFAULT_STRING_FORMAT);
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
