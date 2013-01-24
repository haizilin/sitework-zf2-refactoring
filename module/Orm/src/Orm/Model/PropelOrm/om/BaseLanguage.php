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
use Orm\Model\PropelOrm\CategoryDetail;
use Orm\Model\PropelOrm\CategoryDetailQuery;
use Orm\Model\PropelOrm\Language;
use Orm\Model\PropelOrm\LanguagePeer;
use Orm\Model\PropelOrm\LanguageQuery;
use Orm\Model\PropelOrm\ProjectDetail;
use Orm\Model\PropelOrm\ProjectDetailQuery;
use Orm\Model\PropelOrm\ServiceDetail;
use Orm\Model\PropelOrm\ServiceDetailQuery;

/**
 * Base class that represents a row from the 'language' table.
 *
 *
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseLanguage extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Orm\\Model\\PropelOrm\\LanguagePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LanguagePeer
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
     * @var        PropelObjectCollection|CategoryDetail[] Collection to store aggregation of CategoryDetail objects.
     */
    protected $collCategoryDetails;
    protected $collCategoryDetailsPartial;

    /**
     * @var        PropelObjectCollection|ServiceDetail[] Collection to store aggregation of ServiceDetail objects.
     */
    protected $collServiceDetails;
    protected $collServiceDetailsPartial;

    /**
     * @var        PropelObjectCollection|ProjectDetail[] Collection to store aggregation of ProjectDetail objects.
     */
    protected $collProjectDetails;
    protected $collProjectDetailsPartial;

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
     * Initializes internal state of BaseLanguage object.
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
     * @return Language The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LanguagePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [locale] column.
     *
     * @param string $v new value
     * @return Language The current object (for fluent API support)
     */
    public function setLocale($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->locale !== $v) {
            $this->locale = $v;
            $this->modifiedColumns[] = LanguagePeer::LOCALE;
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
     * @return Language The current object (for fluent API support)
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
            $this->modifiedColumns[] = LanguagePeer::ACTIVE;
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
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 3; // 3 = LanguagePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Language object", $e);
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
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LanguagePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collCategoryDetails = null;

            $this->collServiceDetails = null;

            $this->collProjectDetails = null;

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
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LanguageQuery::create()
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
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LanguagePeer::addInstanceToPool($this);
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
                    CategoryDetailQuery::create()
                        ->filterByPrimaryKeys($this->categoryDetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->categoryDetailsScheduledForDeletion = null;
                }
            }

            if ($this->collCategoryDetails !== null) {
                foreach ($this->collCategoryDetails as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->serviceDetailsScheduledForDeletion !== null) {
                if (!$this->serviceDetailsScheduledForDeletion->isEmpty()) {
                    ServiceDetailQuery::create()
                        ->filterByPrimaryKeys($this->serviceDetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
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

            if ($this->projectDetailsScheduledForDeletion !== null) {
                if (!$this->projectDetailsScheduledForDeletion->isEmpty()) {
                    ProjectDetailQuery::create()
                        ->filterByPrimaryKeys($this->projectDetailsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->projectDetailsScheduledForDeletion = null;
                }
            }

            if ($this->collProjectDetails !== null) {
                foreach ($this->collProjectDetails as $referrerFK) {
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

        $this->modifiedColumns[] = LanguagePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LanguagePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LanguagePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(LanguagePeer::LOCALE)) {
            $modifiedColumns[':p' . $index++]  = '`locale`';
        }
        if ($this->isColumnModified(LanguagePeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
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
                    case '`id`':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case '`locale`':
                        $stmt->bindValue($identifier, $this->locale, PDO::PARAM_STR);
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


            if (($retval = LanguagePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collCategoryDetails !== null) {
                    foreach ($this->collCategoryDetails as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collServiceDetails !== null) {
                    foreach ($this->collServiceDetails as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collProjectDetails !== null) {
                    foreach ($this->collProjectDetails as $referrerFK) {
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
        $pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
        if (isset($alreadyDumpedObjects['Language'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Language'][$this->getPrimaryKey()] = true;
        $keys = LanguagePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLocale(),
            $keys[2] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->collCategoryDetails) {
                $result['CategoryDetails'] = $this->collCategoryDetails->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collServiceDetails) {
                $result['ServiceDetails'] = $this->collServiceDetails->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collProjectDetails) {
                $result['ProjectDetails'] = $this->collProjectDetails->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LanguagePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
        $keys = LanguagePeer::getFieldNames($keyType);

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
        $criteria = new Criteria(LanguagePeer::DATABASE_NAME);

        if ($this->isColumnModified(LanguagePeer::ID)) $criteria->add(LanguagePeer::ID, $this->id);
        if ($this->isColumnModified(LanguagePeer::LOCALE)) $criteria->add(LanguagePeer::LOCALE, $this->locale);
        if ($this->isColumnModified(LanguagePeer::ACTIVE)) $criteria->add(LanguagePeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(LanguagePeer::DATABASE_NAME);
        $criteria->add(LanguagePeer::ID, $this->id);

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
     * @param object $copyObj An object of Language (or compatible) type.
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

            foreach ($this->getCategoryDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCategoryDetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getServiceDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addServiceDetail($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getProjectDetails() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addProjectDetail($relObj->copy($deepCopy));
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
     * @return Language Clone of current object.
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
     * @return LanguagePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LanguagePeer();
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
        if ('CategoryDetail' == $relationName) {
            $this->initCategoryDetails();
        }
        if ('ServiceDetail' == $relationName) {
            $this->initServiceDetails();
        }
        if ('ProjectDetail' == $relationName) {
            $this->initProjectDetails();
        }
    }

    /**
     * Clears out the collCategoryDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Language The current object (for fluent API support)
     * @see        addCategoryDetails()
     */
    public function clearCategoryDetails()
    {
        $this->collCategoryDetails = null; // important to set this to null since that means it is uninitialized
        $this->collCategoryDetailsPartial = null;

        return $this;
    }

    /**
     * reset is the collCategoryDetails collection loaded partially
     *
     * @return void
     */
    public function resetPartialCategoryDetails($v = true)
    {
        $this->collCategoryDetailsPartial = $v;
    }

    /**
     * Initializes the collCategoryDetails collection.
     *
     * By default this just sets the collCategoryDetails collection to an empty array (like clearcollCategoryDetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCategoryDetails($overrideExisting = true)
    {
        if (null !== $this->collCategoryDetails && !$overrideExisting) {
            return;
        }
        $this->collCategoryDetails = new PropelObjectCollection();
        $this->collCategoryDetails->setModel('CategoryDetail');
    }

    /**
     * Gets an array of CategoryDetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Language is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|CategoryDetail[] List of CategoryDetail objects
     * @throws PropelException
     */
    public function getCategoryDetails($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCategoryDetailsPartial && !$this->isNew();
        if (null === $this->collCategoryDetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCategoryDetails) {
                // return empty collection
                $this->initCategoryDetails();
            } else {
                $collCategoryDetails = CategoryDetailQuery::create(null, $criteria)
                    ->filterByLanguage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCategoryDetailsPartial && count($collCategoryDetails)) {
                      $this->initCategoryDetails(false);

                      foreach($collCategoryDetails as $obj) {
                        if (false == $this->collCategoryDetails->contains($obj)) {
                          $this->collCategoryDetails->append($obj);
                        }
                      }

                      $this->collCategoryDetailsPartial = true;
                    }

                    $collCategoryDetails->getInternalIterator()->rewind();
                    return $collCategoryDetails;
                }

                if($partial && $this->collCategoryDetails) {
                    foreach($this->collCategoryDetails as $obj) {
                        if($obj->isNew()) {
                            $collCategoryDetails[] = $obj;
                        }
                    }
                }

                $this->collCategoryDetails = $collCategoryDetails;
                $this->collCategoryDetailsPartial = false;
            }
        }

        return $this->collCategoryDetails;
    }

    /**
     * Sets a collection of CategoryDetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $categoryDetails A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Language The current object (for fluent API support)
     */
    public function setCategoryDetails(PropelCollection $categoryDetails, PropelPDO $con = null)
    {
        $categoryDetailsToDelete = $this->getCategoryDetails(new Criteria(), $con)->diff($categoryDetails);

        $this->categoryDetailsScheduledForDeletion = unserialize(serialize($categoryDetailsToDelete));

        foreach ($categoryDetailsToDelete as $categoryDetailRemoved) {
            $categoryDetailRemoved->setLanguage(null);
        }

        $this->collCategoryDetails = null;
        foreach ($categoryDetails as $categoryDetail) {
            $this->addCategoryDetail($categoryDetail);
        }

        $this->collCategoryDetails = $categoryDetails;
        $this->collCategoryDetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related CategoryDetail objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related CategoryDetail objects.
     * @throws PropelException
     */
    public function countCategoryDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCategoryDetailsPartial && !$this->isNew();
        if (null === $this->collCategoryDetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCategoryDetails) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getCategoryDetails());
            }
            $query = CategoryDetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLanguage($this)
                ->count($con);
        }

        return count($this->collCategoryDetails);
    }

    /**
     * Method called to associate a CategoryDetail object to this object
     * through the CategoryDetail foreign key attribute.
     *
     * @param    CategoryDetail $l CategoryDetail
     * @return Language The current object (for fluent API support)
     */
    public function addCategoryDetail(CategoryDetail $l)
    {
        if ($this->collCategoryDetails === null) {
            $this->initCategoryDetails();
            $this->collCategoryDetailsPartial = true;
        }
        if (!in_array($l, $this->collCategoryDetails->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCategoryDetail($l);
        }

        return $this;
    }

    /**
     * @param	CategoryDetail $categoryDetail The categoryDetail object to add.
     */
    protected function doAddCategoryDetail($categoryDetail)
    {
        $this->collCategoryDetails[]= $categoryDetail;
        $categoryDetail->setLanguage($this);
    }

    /**
     * @param	CategoryDetail $categoryDetail The categoryDetail object to remove.
     * @return Language The current object (for fluent API support)
     */
    public function removeCategoryDetail($categoryDetail)
    {
        if ($this->getCategoryDetails()->contains($categoryDetail)) {
            $this->collCategoryDetails->remove($this->collCategoryDetails->search($categoryDetail));
            if (null === $this->categoryDetailsScheduledForDeletion) {
                $this->categoryDetailsScheduledForDeletion = clone $this->collCategoryDetails;
                $this->categoryDetailsScheduledForDeletion->clear();
            }
            $this->categoryDetailsScheduledForDeletion[]= clone $categoryDetail;
            $categoryDetail->setLanguage(null);
        }

        return $this;
    }

    /**
     * Clears out the collServiceDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Language The current object (for fluent API support)
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
     * If this Language is new, it will return
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
                    ->filterByLanguage($this)
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
     * @return Language The current object (for fluent API support)
     */
    public function setServiceDetails(PropelCollection $serviceDetails, PropelPDO $con = null)
    {
        $serviceDetailsToDelete = $this->getServiceDetails(new Criteria(), $con)->diff($serviceDetails);

        $this->serviceDetailsScheduledForDeletion = unserialize(serialize($serviceDetailsToDelete));

        foreach ($serviceDetailsToDelete as $serviceDetailRemoved) {
            $serviceDetailRemoved->setLanguage(null);
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
                ->filterByLanguage($this)
                ->count($con);
        }

        return count($this->collServiceDetails);
    }

    /**
     * Method called to associate a ServiceDetail object to this object
     * through the ServiceDetail foreign key attribute.
     *
     * @param    ServiceDetail $l ServiceDetail
     * @return Language The current object (for fluent API support)
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
        $serviceDetail->setLanguage($this);
    }

    /**
     * @param	ServiceDetail $serviceDetail The serviceDetail object to remove.
     * @return Language The current object (for fluent API support)
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
            $serviceDetail->setLanguage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Language is new, it will return
     * an empty collection; or if this Language has previously
     * been saved, it will retrieve related ServiceDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Language.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ServiceDetail[] List of ServiceDetail objects
     */
    public function getServiceDetailsJoinService($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ServiceDetailQuery::create(null, $criteria);
        $query->joinWith('Service', $join_behavior);

        return $this->getServiceDetails($query, $con);
    }

    /**
     * Clears out the collProjectDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Language The current object (for fluent API support)
     * @see        addProjectDetails()
     */
    public function clearProjectDetails()
    {
        $this->collProjectDetails = null; // important to set this to null since that means it is uninitialized
        $this->collProjectDetailsPartial = null;

        return $this;
    }

    /**
     * reset is the collProjectDetails collection loaded partially
     *
     * @return void
     */
    public function resetPartialProjectDetails($v = true)
    {
        $this->collProjectDetailsPartial = $v;
    }

    /**
     * Initializes the collProjectDetails collection.
     *
     * By default this just sets the collProjectDetails collection to an empty array (like clearcollProjectDetails());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initProjectDetails($overrideExisting = true)
    {
        if (null !== $this->collProjectDetails && !$overrideExisting) {
            return;
        }
        $this->collProjectDetails = new PropelObjectCollection();
        $this->collProjectDetails->setModel('ProjectDetail');
    }

    /**
     * Gets an array of ProjectDetail objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Language is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|ProjectDetail[] List of ProjectDetail objects
     * @throws PropelException
     */
    public function getProjectDetails($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collProjectDetailsPartial && !$this->isNew();
        if (null === $this->collProjectDetails || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collProjectDetails) {
                // return empty collection
                $this->initProjectDetails();
            } else {
                $collProjectDetails = ProjectDetailQuery::create(null, $criteria)
                    ->filterByLanguage($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collProjectDetailsPartial && count($collProjectDetails)) {
                      $this->initProjectDetails(false);

                      foreach($collProjectDetails as $obj) {
                        if (false == $this->collProjectDetails->contains($obj)) {
                          $this->collProjectDetails->append($obj);
                        }
                      }

                      $this->collProjectDetailsPartial = true;
                    }

                    $collProjectDetails->getInternalIterator()->rewind();
                    return $collProjectDetails;
                }

                if($partial && $this->collProjectDetails) {
                    foreach($this->collProjectDetails as $obj) {
                        if($obj->isNew()) {
                            $collProjectDetails[] = $obj;
                        }
                    }
                }

                $this->collProjectDetails = $collProjectDetails;
                $this->collProjectDetailsPartial = false;
            }
        }

        return $this->collProjectDetails;
    }

    /**
     * Sets a collection of ProjectDetail objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $projectDetails A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Language The current object (for fluent API support)
     */
    public function setProjectDetails(PropelCollection $projectDetails, PropelPDO $con = null)
    {
        $projectDetailsToDelete = $this->getProjectDetails(new Criteria(), $con)->diff($projectDetails);

        $this->projectDetailsScheduledForDeletion = unserialize(serialize($projectDetailsToDelete));

        foreach ($projectDetailsToDelete as $projectDetailRemoved) {
            $projectDetailRemoved->setLanguage(null);
        }

        $this->collProjectDetails = null;
        foreach ($projectDetails as $projectDetail) {
            $this->addProjectDetail($projectDetail);
        }

        $this->collProjectDetails = $projectDetails;
        $this->collProjectDetailsPartial = false;

        return $this;
    }

    /**
     * Returns the number of related ProjectDetail objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related ProjectDetail objects.
     * @throws PropelException
     */
    public function countProjectDetails(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collProjectDetailsPartial && !$this->isNew();
        if (null === $this->collProjectDetails || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collProjectDetails) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getProjectDetails());
            }
            $query = ProjectDetailQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLanguage($this)
                ->count($con);
        }

        return count($this->collProjectDetails);
    }

    /**
     * Method called to associate a ProjectDetail object to this object
     * through the ProjectDetail foreign key attribute.
     *
     * @param    ProjectDetail $l ProjectDetail
     * @return Language The current object (for fluent API support)
     */
    public function addProjectDetail(ProjectDetail $l)
    {
        if ($this->collProjectDetails === null) {
            $this->initProjectDetails();
            $this->collProjectDetailsPartial = true;
        }
        if (!in_array($l, $this->collProjectDetails->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddProjectDetail($l);
        }

        return $this;
    }

    /**
     * @param	ProjectDetail $projectDetail The projectDetail object to add.
     */
    protected function doAddProjectDetail($projectDetail)
    {
        $this->collProjectDetails[]= $projectDetail;
        $projectDetail->setLanguage($this);
    }

    /**
     * @param	ProjectDetail $projectDetail The projectDetail object to remove.
     * @return Language The current object (for fluent API support)
     */
    public function removeProjectDetail($projectDetail)
    {
        if ($this->getProjectDetails()->contains($projectDetail)) {
            $this->collProjectDetails->remove($this->collProjectDetails->search($projectDetail));
            if (null === $this->projectDetailsScheduledForDeletion) {
                $this->projectDetailsScheduledForDeletion = clone $this->collProjectDetails;
                $this->projectDetailsScheduledForDeletion->clear();
            }
            $this->projectDetailsScheduledForDeletion[]= clone $projectDetail;
            $projectDetail->setLanguage(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Language is new, it will return
     * an empty collection; or if this Language has previously
     * been saved, it will retrieve related ProjectDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Language.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectDetail[] List of ProjectDetail objects
     */
    public function getProjectDetailsJoinProject($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectDetailQuery::create(null, $criteria);
        $query->joinWith('Project', $join_behavior);

        return $this->getProjectDetails($query, $con);
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
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collCategoryDetails) {
                foreach ($this->collCategoryDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collServiceDetails) {
                foreach ($this->collServiceDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collProjectDetails) {
                foreach ($this->collProjectDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collCategoryDetails instanceof PropelCollection) {
            $this->collCategoryDetails->clearIterator();
        }
        $this->collCategoryDetails = null;
        if ($this->collServiceDetails instanceof PropelCollection) {
            $this->collServiceDetails->clearIterator();
        }
        $this->collServiceDetails = null;
        if ($this->collProjectDetails instanceof PropelCollection) {
            $this->collProjectDetails->clearIterator();
        }
        $this->collProjectDetails = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(LanguagePeer::DEFAULT_STRING_FORMAT);
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
