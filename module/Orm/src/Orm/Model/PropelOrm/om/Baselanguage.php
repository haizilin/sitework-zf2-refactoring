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
use Orm\Model\PropelOrm\categoryDetail;
use Orm\Model\PropelOrm\categoryDetailQuery;
use Orm\Model\PropelOrm\language;
use Orm\Model\PropelOrm\languagePeer;
use Orm\Model\PropelOrm\languageQuery;
use Orm\Model\PropelOrm\projectDetail;
use Orm\Model\PropelOrm\projectDetailQuery;
use Orm\Model\PropelOrm\serviceDetail;
use Orm\Model\PropelOrm\serviceDetailQuery;

/**
 * Base class that represents a row from the 'language' table.
 *
 *
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class Baselanguage extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Orm\\Model\\PropelOrm\\languagePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        languagePeer
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
     * The value for the locale field.
     * @var        string
     */
    protected $locale;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

    /**
     * @var        PropelObjectCollection|categoryDetail[] Collection to store aggregation of categoryDetail objects.
     */
    protected $collcategoryDetails;
    protected $collcategoryDetailsPartial;

    /**
     * @var        PropelObjectCollection|serviceDetail[] Collection to store aggregation of serviceDetail objects.
     */
    protected $collserviceDetails;
    protected $collserviceDetailsPartial;

    /**
     * @var        PropelObjectCollection|projectDetail[] Collection to store aggregation of projectDetail objects.
     */
    protected $collprojectDetails;
    protected $collprojectDetailsPartial;

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
    protected $categoryDetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $serviceDetailsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $projectDetailsScheduledForDeletion = null;

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
     * Initializes internal state of Baselanguage object.
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
     * Get the [locale] column value.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
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
     * @return language The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = languagePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [locale] column.
     *
     * @param string $v new value
     * @return language The current object (for fluent API support)
     */
    public function setLocale($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->locale !== $v) {
            $this->locale = $v;
            $this->modifiedColumns[] = languagePeer::LOCALE;
        }


        return $this;
    } // setLocale()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return language The current object (for fluent API support)
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
            $this->modifiedColumns[] = languagePeer::ACTIVE;
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
            $this->locale = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->active = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = languagePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating language object", $e);
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
            $con = Propel::getConnection(languagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = languagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collcategoryDetails = null;

            $this->collserviceDetails = null;

            $this->collprojectDetails = null;

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
            $con = Propel::getConnection(languagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = languageQuery::create()
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
            $con = Propel::getConnection(languagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                languagePeer::addInstanceToPool($this);
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

            if ($this->categoryDetailsScheduledForDeletion !== null) {
                if (!$this->categoryDetailsScheduledForDeletion->isEmpty()) {
                    categoryDetailQuery::create()
                        ->filterByPrimaryKeys($this->categoryDetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->categoryDetailsScheduledForDeletion = null;
                }
            }

            if ($this->collcategoryDetails !== null) {
                foreach ($this->collcategoryDetails as $referrerFK) {
                    if (!$referrerFK->isDeleted()) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

            if ($this->projectDetailsScheduledForDeletion !== null) {
                if (!$this->projectDetailsScheduledForDeletion->isEmpty()) {
                    projectDetailQuery::create()
                        ->filterByPrimaryKeys($this->projectDetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->projectDetailsScheduledForDeletion = null;
                }
            }

            if ($this->collprojectDetails !== null) {
                foreach ($this->collprojectDetails as $referrerFK) {
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

        $this->modifiedColumns[] = languagePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . languagePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(languagePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`ID`';
        }
        if ($this->isColumnModified(languagePeer::LOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`LOCALE`';
        }
        if ($this->isColumnModified(languagePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`ACTIVE`';
        }

        $sql = sprintf(
            'INSERT INTO `language` (%s) VALUES (%s)',
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
                    case '`LOCALE`':
                        $stmt->bindValue($identifier, $this->locale, PDO::PARAM_STR);
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


            if (($retval = languagePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collcategoryDetails !== null) {
                    foreach ($this->collcategoryDetails as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collserviceDetails !== null) {
                    foreach ($this->collserviceDetails as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collprojectDetails !== null) {
                    foreach ($this->collprojectDetails as $referrerFK) {
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
        $pos = languagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getLocale();
                break;
            case 2:
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
        if (isset($alreadyDumpedObjects['language'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['language'][$this->getPrimaryKey()] = true;
        $keys = languagePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLocale(),
            $keys[2] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collcategoryDetails) {
                $result['categoryDetails'] = $this->collcategoryDetails->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collserviceDetails) {
                $result['serviceDetails'] = $this->collserviceDetails->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collprojectDetails) {
                $result['projectDetails'] = $this->collprojectDetails->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = languagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setLocale($value);
                break;
            case 2:
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
        $keys = languagePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setLocale($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setActive($arr[$keys[2]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(languagePeer::DATABASE_NAME);

        if ($this->isColumnModified(languagePeer::ID)) $criteria->add(languagePeer::ID, $this->id);
        if ($this->isColumnModified(languagePeer::LOCALE)) $criteria->add(languagePeer::LOCALE, $this->locale);
        if ($this->isColumnModified(languagePeer::ACTIVE)) $criteria->add(languagePeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(languagePeer::DATABASE_NAME);
        $criteria->add(languagePeer::ID, $this->id);

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
     * @param object $copyObj An object of language (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLocale($this->getLocale());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getcategoryDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addcategoryDetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getserviceDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addserviceDetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getprojectDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addprojectDetail($relObj->copy($deepCopy));
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
     * @return language Clone of current object.
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
     * @return languagePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new languagePeer();
        }

        return self::$peer;
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
        if ('categoryDetail' == $relationName) {
            $this->initcategoryDetails();
        }
        if ('serviceDetail' == $relationName) {
            $this->initserviceDetails();
        }
        if ('projectDetail' == $relationName) {
            $this->initprojectDetails();
        }
    }

    /**
     * Clears out the collcategoryDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addcategoryDetails()
     */
    public function clearcategoryDetails()
    {
        $this->collcategoryDetails = null; // important to set this to null since that means it is uninitialized
        $this->collcategoryDetailsPartial = null;
    }

    /**
     * reset is the collcategoryDetails collection loaded partially
     *
     * @return void
     */
    public function resetPartialcategoryDetails($v = true)
    {
        $this->collcategoryDetailsPartial = $v;
    }

    /**
     * Initializes the collcategoryDetails collection.
     *
     * By default this just sets the collcategoryDetails collection to an empty array (like clearcollcategoryDetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initcategoryDetails($overrideExisting = true)
    {
        if (null !== $this->collcategoryDetails && !$overrideExisting) {
            return;
        }
        $this->collcategoryDetails = new PropelObjectCollection();
        $this->collcategoryDetails->setModel('categoryDetail');
    }

    /**
     * Gets an array of categoryDetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this language is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|categoryDetail[] List of categoryDetail objects
     * @throws PropelException
     */
    public function getcategoryDetails($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collcategoryDetailsPartial && !$this->isNew();
        if (null === $this->collcategoryDetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collcategoryDetails) {
                // return empty collection
                $this->initcategoryDetails();
            } else {
                $collcategoryDetails = categoryDetailQuery::create(null, $criteria)
                    ->filterBylanguage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collcategoryDetailsPartial && count($collcategoryDetails)) {
                      $this->initcategoryDetails(false);

                      foreach($collcategoryDetails as $obj) {
                        if (false == $this->collcategoryDetails->contains($obj)) {
                          $this->collcategoryDetails->append($obj);
                        }
                      }

                      $this->collcategoryDetailsPartial = true;
                    }

                    return $collcategoryDetails;
                }

                if($partial && $this->collcategoryDetails) {
                    foreach($this->collcategoryDetails as $obj) {
                        if($obj->isNew()) {
                            $collcategoryDetails[] = $obj;
                        }
                    }
                }

                $this->collcategoryDetails = $collcategoryDetails;
                $this->collcategoryDetailsPartial = false;
            }
        }

        return $this->collcategoryDetails;
    }

    /**
     * Sets a collection of categoryDetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $categoryDetails A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setcategoryDetails(PropelCollection $categoryDetails, PropelPDO $con = null)
    {
        $this->categoryDetailsScheduledForDeletion = $this->getcategoryDetails(new Criteria(), $con)->diff($categoryDetails);

        foreach ($this->categoryDetailsScheduledForDeletion as $categoryDetailRemoved) {
            $categoryDetailRemoved->setlanguage(null);
        }

        $this->collcategoryDetails = null;
        foreach ($categoryDetails as $categoryDetail) {
            $this->addcategoryDetail($categoryDetail);
        }

        $this->collcategoryDetails = $categoryDetails;
        $this->collcategoryDetailsPartial = false;
    }

    /**
     * Returns the number of related categoryDetail objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related categoryDetail objects.
     * @throws PropelException
     */
    public function countcategoryDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collcategoryDetailsPartial && !$this->isNew();
        if (null === $this->collcategoryDetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collcategoryDetails) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getcategoryDetails());
                }
                $query = categoryDetailQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBylanguage($this)
                    ->count($con);
            }
        } else {
            return count($this->collcategoryDetails);
        }
    }

    /**
     * Method called to associate a categoryDetail object to this object
     * through the categoryDetail foreign key attribute.
     *
     * @param    categoryDetail $l categoryDetail
     * @return language The current object (for fluent API support)
     */
    public function addcategoryDetail(categoryDetail $l)
    {
        if ($this->collcategoryDetails === null) {
            $this->initcategoryDetails();
            $this->collcategoryDetailsPartial = true;
        }
        if (!$this->collcategoryDetails->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddcategoryDetail($l);
        }

        return $this;
    }

    /**
     * @param	categoryDetail $categoryDetail The categoryDetail object to add.
     */
    protected function doAddcategoryDetail($categoryDetail)
    {
        $this->collcategoryDetails[]= $categoryDetail;
        $categoryDetail->setlanguage($this);
    }

    /**
     * @param	categoryDetail $categoryDetail The categoryDetail object to remove.
     */
    public function removecategoryDetail($categoryDetail)
    {
        if ($this->getcategoryDetails()->contains($categoryDetail)) {
            $this->collcategoryDetails->remove($this->collcategoryDetails->search($categoryDetail));
            if (null === $this->categoryDetailsScheduledForDeletion) {
                $this->categoryDetailsScheduledForDeletion = clone $this->collcategoryDetails;
                $this->categoryDetailsScheduledForDeletion->clear();
            }
            $this->categoryDetailsScheduledForDeletion[]= $categoryDetail;
            $categoryDetail->setlanguage(null);
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
     * If this language is new, it will return
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
                    ->filterBylanguage($this)
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
            $serviceDetailRemoved->setlanguage(null);
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
                    ->filterBylanguage($this)
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
     * @return language The current object (for fluent API support)
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
        $serviceDetail->setlanguage($this);
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
            $serviceDetail->setlanguage(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this language is new, it will return
     * an empty collection; or if this language has previously
     * been saved, it will retrieve related serviceDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in language.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|serviceDetail[] List of serviceDetail objects
     */
    public function getserviceDetailsJoinservice($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = serviceDetailQuery::create(null, $criteria);
        $query->joinWith('service', $join_behavior);

        return $this->getserviceDetails($query, $con);
    }

    /**
     * Clears out the collprojectDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addprojectDetails()
     */
    public function clearprojectDetails()
    {
        $this->collprojectDetails = null; // important to set this to null since that means it is uninitialized
        $this->collprojectDetailsPartial = null;
    }

    /**
     * reset is the collprojectDetails collection loaded partially
     *
     * @return void
     */
    public function resetPartialprojectDetails($v = true)
    {
        $this->collprojectDetailsPartial = $v;
    }

    /**
     * Initializes the collprojectDetails collection.
     *
     * By default this just sets the collprojectDetails collection to an empty array (like clearcollprojectDetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initprojectDetails($overrideExisting = true)
    {
        if (null !== $this->collprojectDetails && !$overrideExisting) {
            return;
        }
        $this->collprojectDetails = new PropelObjectCollection();
        $this->collprojectDetails->setModel('projectDetail');
    }

    /**
     * Gets an array of projectDetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this language is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|projectDetail[] List of projectDetail objects
     * @throws PropelException
     */
    public function getprojectDetails($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collprojectDetailsPartial && !$this->isNew();
        if (null === $this->collprojectDetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collprojectDetails) {
                // return empty collection
                $this->initprojectDetails();
            } else {
                $collprojectDetails = projectDetailQuery::create(null, $criteria)
                    ->filterBylanguage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collprojectDetailsPartial && count($collprojectDetails)) {
                      $this->initprojectDetails(false);

                      foreach($collprojectDetails as $obj) {
                        if (false == $this->collprojectDetails->contains($obj)) {
                          $this->collprojectDetails->append($obj);
                        }
                      }

                      $this->collprojectDetailsPartial = true;
                    }

                    return $collprojectDetails;
                }

                if($partial && $this->collprojectDetails) {
                    foreach($this->collprojectDetails as $obj) {
                        if($obj->isNew()) {
                            $collprojectDetails[] = $obj;
                        }
                    }
                }

                $this->collprojectDetails = $collprojectDetails;
                $this->collprojectDetailsPartial = false;
            }
        }

        return $this->collprojectDetails;
    }

    /**
     * Sets a collection of projectDetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectDetails A Propel collection.
     * @param PropelPDO $con Optional connection object
     */
    public function setprojectDetails(PropelCollection $projectDetails, PropelPDO $con = null)
    {
        $this->projectDetailsScheduledForDeletion = $this->getprojectDetails(new Criteria(), $con)->diff($projectDetails);

        foreach ($this->projectDetailsScheduledForDeletion as $projectDetailRemoved) {
            $projectDetailRemoved->setlanguage(null);
        }

        $this->collprojectDetails = null;
        foreach ($projectDetails as $projectDetail) {
            $this->addprojectDetail($projectDetail);
        }

        $this->collprojectDetails = $projectDetails;
        $this->collprojectDetailsPartial = false;
    }

    /**
     * Returns the number of related projectDetail objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related projectDetail objects.
     * @throws PropelException
     */
    public function countprojectDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collprojectDetailsPartial && !$this->isNew();
        if (null === $this->collprojectDetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collprojectDetails) {
                return 0;
            } else {
                if($partial && !$criteria) {
                    return count($this->getprojectDetails());
                }
                $query = projectDetailQuery::create(null, $criteria);
                if ($distinct) {
                    $query->distinct();
                }

                return $query
                    ->filterBylanguage($this)
                    ->count($con);
            }
        } else {
            return count($this->collprojectDetails);
        }
    }

    /**
     * Method called to associate a projectDetail object to this object
     * through the projectDetail foreign key attribute.
     *
     * @param    projectDetail $l projectDetail
     * @return language The current object (for fluent API support)
     */
    public function addprojectDetail(projectDetail $l)
    {
        if ($this->collprojectDetails === null) {
            $this->initprojectDetails();
            $this->collprojectDetailsPartial = true;
        }
        if (!$this->collprojectDetails->contains($l)) { // only add it if the **same** object is not already associated
            $this->doAddprojectDetail($l);
        }

        return $this;
    }

    /**
     * @param	projectDetail $projectDetail The projectDetail object to add.
     */
    protected function doAddprojectDetail($projectDetail)
    {
        $this->collprojectDetails[]= $projectDetail;
        $projectDetail->setlanguage($this);
    }

    /**
     * @param	projectDetail $projectDetail The projectDetail object to remove.
     */
    public function removeprojectDetail($projectDetail)
    {
        if ($this->getprojectDetails()->contains($projectDetail)) {
            $this->collprojectDetails->remove($this->collprojectDetails->search($projectDetail));
            if (null === $this->projectDetailsScheduledForDeletion) {
                $this->projectDetailsScheduledForDeletion = clone $this->collprojectDetails;
                $this->projectDetailsScheduledForDeletion->clear();
            }
            $this->projectDetailsScheduledForDeletion[]= $projectDetail;
            $projectDetail->setlanguage(null);
        }
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this language is new, it will return
     * an empty collection; or if this language has previously
     * been saved, it will retrieve related projectDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in language.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|projectDetail[] List of projectDetail objects
     */
    public function getprojectDetailsJoinproject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = projectDetailQuery::create(null, $criteria);
        $query->joinWith('project', $join_behavior);

        return $this->getprojectDetails($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->locale = null;
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
            if ($this->collcategoryDetails) {
                foreach ($this->collcategoryDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collserviceDetails) {
                foreach ($this->collserviceDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collprojectDetails) {
                foreach ($this->collprojectDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        if ($this->collcategoryDetails instanceof PropelCollection) {
            $this->collcategoryDetails->clearIterator();
        }
        $this->collcategoryDetails = null;
        if ($this->collserviceDetails instanceof PropelCollection) {
            $this->collserviceDetails->clearIterator();
        }
        $this->collserviceDetails = null;
        if ($this->collprojectDetails instanceof PropelCollection) {
            $this->collprojectDetails->clearIterator();
        }
        $this->collprojectDetails = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(languagePeer::DEFAULT_STRING_FORMAT);
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
