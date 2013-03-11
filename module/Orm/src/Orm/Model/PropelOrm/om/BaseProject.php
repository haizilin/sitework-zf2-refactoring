<?php

namespace Orm\Model\PropelOrm\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Orm\Model\PropelOrm\Contact;
use Orm\Model\PropelOrm\ContactQuery;
use Orm\Model\PropelOrm\Project;
use Orm\Model\PropelOrm\ProjectDetail;
use Orm\Model\PropelOrm\ProjectDetailQuery;
use Orm\Model\PropelOrm\ProjectPeer;
use Orm\Model\PropelOrm\ProjectQuery;

/**
 * Base class that represents a row from the 'project' table.
 *
 *
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseProject extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Orm\\Model\\PropelOrm\\ProjectPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        ProjectPeer
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
     * The value for the fk_contact_client_id field.
     * @var        int
     */
    protected $fk_contact_client_id;

    /**
     * The value for the fk_contact_employer_id field.
     * @var        int
     */
    protected $fk_contact_employer_id;

    /**
     * The value for the started_at field.
     * @var        string
     */
    protected $started_at;

    /**
     * The value for the finished_at field.
     * @var        string
     */
    protected $finished_at;

    /**
     * The value for the url field.
     * @var        string
     */
    protected $url;

    /**
     * The value for the img field.
     * @var        string
     */
    protected $img;

    /**
     * The value for the active field.
     * Note: this column has a database default value of: true
     * @var        boolean
     */
    protected $active;

    /**
     * @var        Contact
     */
    protected $aContactRelatedByFkContactClientId;

    /**
     * @var        Contact
     */
    protected $aContactRelatedByFkContactEmployerId;

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
     * Initializes internal state of BaseProject object.
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
     * Get the [fk_contact_client_id] column value.
     *
     * @return int
     */
    public function getFkContactClientId()
    {
        return $this->fk_contact_client_id;
    }

    /**
     * Get the [fk_contact_employer_id] column value.
     *
     * @return int
     */
    public function getFkContactEmployerId()
    {
        return $this->fk_contact_employer_id;
    }

    /**
     * Get the [optionally formatted] temporal [started_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getStartedAt($format = '%x')
    {
        if ($this->started_at === null) {
            return null;
        }

        if ($this->started_at === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->started_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->started_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [optionally formatted] temporal [finished_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getFinishedAt($format = '%x')
    {
        if ($this->finished_at === null) {
            return null;
        }

        if ($this->finished_at === '0000-00-00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->finished_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->finished_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [url] column value.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get the [img] column value.
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
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
     * @return Project The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = ProjectPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [fk_contact_client_id] column.
     *
     * @param int $v new value
     * @return Project The current object (for fluent API support)
     */
    public function setFkContactClientId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->fk_contact_client_id !== $v) {
            $this->fk_contact_client_id = $v;
            $this->modifiedColumns[] = ProjectPeer::FK_CONTACT_CLIENT_ID;
        }

        if ($this->aContactRelatedByFkContactClientId !== null && $this->aContactRelatedByFkContactClientId->getId() !== $v) {
            $this->aContactRelatedByFkContactClientId = null;
        }


        return $this;
    } // setFkContactClientId()

    /**
     * Set the value of [fk_contact_employer_id] column.
     *
     * @param int $v new value
     * @return Project The current object (for fluent API support)
     */
    public function setFkContactEmployerId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->fk_contact_employer_id !== $v) {
            $this->fk_contact_employer_id = $v;
            $this->modifiedColumns[] = ProjectPeer::FK_CONTACT_EMPLOYER_ID;
        }

        if ($this->aContactRelatedByFkContactEmployerId !== null && $this->aContactRelatedByFkContactEmployerId->getId() !== $v) {
            $this->aContactRelatedByFkContactEmployerId = null;
        }


        return $this;
    } // setFkContactEmployerId()

    /**
     * Sets the value of [started_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Project The current object (for fluent API support)
     */
    public function setStartedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->started_at !== null || $dt !== null) {
            $currentDateAsString = ($this->started_at !== null && $tmpDt = new DateTime($this->started_at)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->started_at = $newDateAsString;
                $this->modifiedColumns[] = ProjectPeer::STARTED_AT;
            }
        } // if either are not null


        return $this;
    } // setStartedAt()

    /**
     * Sets the value of [finished_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Project The current object (for fluent API support)
     */
    public function setFinishedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->finished_at !== null || $dt !== null) {
            $currentDateAsString = ($this->finished_at !== null && $tmpDt = new DateTime($this->finished_at)) ? $tmpDt->format('Y-m-d') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->finished_at = $newDateAsString;
                $this->modifiedColumns[] = ProjectPeer::FINISHED_AT;
            }
        } // if either are not null


        return $this;
    } // setFinishedAt()

    /**
     * Set the value of [url] column.
     *
     * @param string $v new value
     * @return Project The current object (for fluent API support)
     */
    public function setUrl($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->url !== $v) {
            $this->url = $v;
            $this->modifiedColumns[] = ProjectPeer::URL;
        }


        return $this;
    } // setUrl()

    /**
     * Set the value of [img] column.
     *
     * @param string $v new value
     * @return Project The current object (for fluent API support)
     */
    public function setImg($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->img !== $v) {
            $this->img = $v;
            $this->modifiedColumns[] = ProjectPeer::IMG;
        }


        return $this;
    } // setImg()

    /**
     * Sets the value of the [active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Project The current object (for fluent API support)
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
            $this->modifiedColumns[] = ProjectPeer::ACTIVE;
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
            $this->fk_contact_client_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->fk_contact_employer_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->started_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->finished_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->url = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->img = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->active = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 8; // 8 = ProjectPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Project object", $e);
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

        if ($this->aContactRelatedByFkContactClientId !== null && $this->fk_contact_client_id !== $this->aContactRelatedByFkContactClientId->getId()) {
            $this->aContactRelatedByFkContactClientId = null;
        }
        if ($this->aContactRelatedByFkContactEmployerId !== null && $this->fk_contact_employer_id !== $this->aContactRelatedByFkContactEmployerId->getId()) {
            $this->aContactRelatedByFkContactEmployerId = null;
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
            $con = Propel::getConnection(ProjectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = ProjectPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aContactRelatedByFkContactClientId = null;
            $this->aContactRelatedByFkContactEmployerId = null;
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
            $con = Propel::getConnection(ProjectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = ProjectQuery::create()
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
            $con = Propel::getConnection(ProjectPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                ProjectPeer::addInstanceToPool($this);
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

            if ($this->aContactRelatedByFkContactClientId !== null) {
                if ($this->aContactRelatedByFkContactClientId->isModified() || $this->aContactRelatedByFkContactClientId->isNew()) {
                    $affectedRows += $this->aContactRelatedByFkContactClientId->save($con);
                }
                $this->setContactRelatedByFkContactClientId($this->aContactRelatedByFkContactClientId);
            }

            if ($this->aContactRelatedByFkContactEmployerId !== null) {
                if ($this->aContactRelatedByFkContactEmployerId->isModified() || $this->aContactRelatedByFkContactEmployerId->isNew()) {
                    $affectedRows += $this->aContactRelatedByFkContactEmployerId->save($con);
                }
                $this->setContactRelatedByFkContactEmployerId($this->aContactRelatedByFkContactEmployerId);
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

            if ($this->projectDetailsScheduledForDeletion !== null) {
                if (!$this->projectDetailsScheduledForDeletion->isEmpty()) {
                    //the foreign key is flagged as `CASCADE`, so we delete the items
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

        $this->modifiedColumns[] = ProjectPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ProjectPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ProjectPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = '`id`';
        }
        if ($this->isColumnModified(ProjectPeer::FK_CONTACT_CLIENT_ID)) {
            $modifiedColumns[':p' . $index++]  = '`fk_contact_client_id`';
        }
        if ($this->isColumnModified(ProjectPeer::FK_CONTACT_EMPLOYER_ID)) {
            $modifiedColumns[':p' . $index++]  = '`fk_contact_employer_id`';
        }
        if ($this->isColumnModified(ProjectPeer::STARTED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`started_at`';
        }
        if ($this->isColumnModified(ProjectPeer::FINISHED_AT)) {
            $modifiedColumns[':p' . $index++]  = '`finished_at`';
        }
        if ($this->isColumnModified(ProjectPeer::URL)) {
            $modifiedColumns[':p' . $index++]  = '`url`';
        }
        if ($this->isColumnModified(ProjectPeer::IMG)) {
            $modifiedColumns[':p' . $index++]  = '`img`';
        }
        if ($this->isColumnModified(ProjectPeer::ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = '`active`';
        }

        $sql = sprintf(
            'INSERT INTO `project` (%s) VALUES (%s)',
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
                    case '`fk_contact_client_id`':
                        $stmt->bindValue($identifier, $this->fk_contact_client_id, PDO::PARAM_INT);
                        break;
                    case '`fk_contact_employer_id`':
                        $stmt->bindValue($identifier, $this->fk_contact_employer_id, PDO::PARAM_INT);
                        break;
                    case '`started_at`':
                        $stmt->bindValue($identifier, $this->started_at, PDO::PARAM_STR);
                        break;
                    case '`finished_at`':
                        $stmt->bindValue($identifier, $this->finished_at, PDO::PARAM_STR);
                        break;
                    case '`url`':
                        $stmt->bindValue($identifier, $this->url, PDO::PARAM_STR);
                        break;
                    case '`img`':
                        $stmt->bindValue($identifier, $this->img, PDO::PARAM_STR);
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

            if ($this->aContactRelatedByFkContactClientId !== null) {
                if (!$this->aContactRelatedByFkContactClientId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aContactRelatedByFkContactClientId->getValidationFailures());
                }
            }

            if ($this->aContactRelatedByFkContactEmployerId !== null) {
                if (!$this->aContactRelatedByFkContactEmployerId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aContactRelatedByFkContactEmployerId->getValidationFailures());
                }
            }


            if (($retval = ProjectPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = ProjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getFkContactClientId();
                break;
            case 2:
                return $this->getFkContactEmployerId();
                break;
            case 3:
                return $this->getStartedAt();
                break;
            case 4:
                return $this->getFinishedAt();
                break;
            case 5:
                return $this->getUrl();
                break;
            case 6:
                return $this->getImg();
                break;
            case 7:
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
        if (isset($alreadyDumpedObjects['Project'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Project'][$this->getPrimaryKey()] = true;
        $keys = ProjectPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getFkContactClientId(),
            $keys[2] => $this->getFkContactEmployerId(),
            $keys[3] => $this->getStartedAt(),
            $keys[4] => $this->getFinishedAt(),
            $keys[5] => $this->getUrl(),
            $keys[6] => $this->getImg(),
            $keys[7] => $this->getActive(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aContactRelatedByFkContactClientId) {
                $result['ContactRelatedByFkContactClientId'] = $this->aContactRelatedByFkContactClientId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aContactRelatedByFkContactEmployerId) {
                $result['ContactRelatedByFkContactEmployerId'] = $this->aContactRelatedByFkContactEmployerId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = ProjectPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setFkContactClientId($value);
                break;
            case 2:
                $this->setFkContactEmployerId($value);
                break;
            case 3:
                $this->setStartedAt($value);
                break;
            case 4:
                $this->setFinishedAt($value);
                break;
            case 5:
                $this->setUrl($value);
                break;
            case 6:
                $this->setImg($value);
                break;
            case 7:
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
        $keys = ProjectPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setFkContactClientId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setFkContactEmployerId($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setStartedAt($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setFinishedAt($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUrl($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setImg($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setActive($arr[$keys[7]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ProjectPeer::DATABASE_NAME);

        if ($this->isColumnModified(ProjectPeer::ID)) $criteria->add(ProjectPeer::ID, $this->id);
        if ($this->isColumnModified(ProjectPeer::FK_CONTACT_CLIENT_ID)) $criteria->add(ProjectPeer::FK_CONTACT_CLIENT_ID, $this->fk_contact_client_id);
        if ($this->isColumnModified(ProjectPeer::FK_CONTACT_EMPLOYER_ID)) $criteria->add(ProjectPeer::FK_CONTACT_EMPLOYER_ID, $this->fk_contact_employer_id);
        if ($this->isColumnModified(ProjectPeer::STARTED_AT)) $criteria->add(ProjectPeer::STARTED_AT, $this->started_at);
        if ($this->isColumnModified(ProjectPeer::FINISHED_AT)) $criteria->add(ProjectPeer::FINISHED_AT, $this->finished_at);
        if ($this->isColumnModified(ProjectPeer::URL)) $criteria->add(ProjectPeer::URL, $this->url);
        if ($this->isColumnModified(ProjectPeer::IMG)) $criteria->add(ProjectPeer::IMG, $this->img);
        if ($this->isColumnModified(ProjectPeer::ACTIVE)) $criteria->add(ProjectPeer::ACTIVE, $this->active);

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
        $criteria = new Criteria(ProjectPeer::DATABASE_NAME);
        $criteria->add(ProjectPeer::ID, $this->id);

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
     * @param object $copyObj An object of Project (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setFkContactClientId($this->getFkContactClientId());
        $copyObj->setFkContactEmployerId($this->getFkContactEmployerId());
        $copyObj->setStartedAt($this->getStartedAt());
        $copyObj->setFinishedAt($this->getFinishedAt());
        $copyObj->setUrl($this->getUrl());
        $copyObj->setImg($this->getImg());
        $copyObj->setActive($this->getActive());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

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
     * @return Project Clone of current object.
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
     * @return ProjectPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new ProjectPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Contact object.
     *
     * @param             Contact $v
     * @return Project The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContactRelatedByFkContactClientId(Contact $v = null)
    {
        if ($v === null) {
            $this->setFkContactClientId(NULL);
        } else {
            $this->setFkContactClientId($v->getId());
        }

        $this->aContactRelatedByFkContactClientId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Contact object, it will not be re-added.
        if ($v !== null) {
            $v->addProjectRelatedByFkContactClientId($this);
        }


        return $this;
    }


    /**
     * Get the associated Contact object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Contact The associated Contact object.
     * @throws PropelException
     */
    public function getContactRelatedByFkContactClientId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aContactRelatedByFkContactClientId === null && ($this->fk_contact_client_id !== null) && $doQuery) {
            $this->aContactRelatedByFkContactClientId = ContactQuery::create()->findPk($this->fk_contact_client_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContactRelatedByFkContactClientId->addProjectsRelatedByFkContactClientId($this);
             */
        }

        return $this->aContactRelatedByFkContactClientId;
    }

    /**
     * Declares an association between this object and a Contact object.
     *
     * @param             Contact $v
     * @return Project The current object (for fluent API support)
     * @throws PropelException
     */
    public function setContactRelatedByFkContactEmployerId(Contact $v = null)
    {
        if ($v === null) {
            $this->setFkContactEmployerId(NULL);
        } else {
            $this->setFkContactEmployerId($v->getId());
        }

        $this->aContactRelatedByFkContactEmployerId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Contact object, it will not be re-added.
        if ($v !== null) {
            $v->addProjectRelatedByFkContactEmployerId($this);
        }


        return $this;
    }


    /**
     * Get the associated Contact object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Contact The associated Contact object.
     * @throws PropelException
     */
    public function getContactRelatedByFkContactEmployerId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aContactRelatedByFkContactEmployerId === null && ($this->fk_contact_employer_id !== null) && $doQuery) {
            $this->aContactRelatedByFkContactEmployerId = ContactQuery::create()->findPk($this->fk_contact_employer_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aContactRelatedByFkContactEmployerId->addProjectsRelatedByFkContactEmployerId($this);
             */
        }

        return $this->aContactRelatedByFkContactEmployerId;
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
        if ('ProjectDetail' == $relationName) {
            $this->initProjectDetails();
        }
    }

    /**
     * Clears out the collProjectDetails collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Project The current object (for fluent API support)
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
     * If this Project is new, it will return
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
                    ->filterByProject($this)
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
     * @return Project The current object (for fluent API support)
     */
    public function setProjectDetails(PropelCollection $projectDetails, PropelPDO $con = null)
    {
        $projectDetailsToDelete = $this->getProjectDetails(new Criteria(), $con)->diff($projectDetails);


        //since at least one column in the foreign key is at the same time a PK
        //we can not just set a PK to NULL in the lines below. We have to store
        //a backup of all values, so we are able to manipulate these items based on the onDelete value later.
        $this->projectDetailsScheduledForDeletion = clone $projectDetailsToDelete;

        foreach ($projectDetailsToDelete as $projectDetailRemoved) {
            $projectDetailRemoved->setProject(null);
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
                ->filterByProject($this)
                ->count($con);
        }

        return count($this->collProjectDetails);
    }

    /**
     * Method called to associate a ProjectDetail object to this object
     * through the ProjectDetail foreign key attribute.
     *
     * @param    ProjectDetail $l ProjectDetail
     * @return Project The current object (for fluent API support)
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
        $projectDetail->setProject($this);
    }

    /**
     * @param	ProjectDetail $projectDetail The projectDetail object to remove.
     * @return Project The current object (for fluent API support)
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
            $projectDetail->setProject(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Project is new, it will return
     * an empty collection; or if this Project has previously
     * been saved, it will retrieve related ProjectDetails from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Project.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|ProjectDetail[] List of ProjectDetail objects
     */
    public function getProjectDetailsJoinLanguage($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = ProjectDetailQuery::create(null, $criteria);
        $query->joinWith('Language', $join_behavior);

        return $this->getProjectDetails($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->fk_contact_client_id = null;
        $this->fk_contact_employer_id = null;
        $this->started_at = null;
        $this->finished_at = null;
        $this->url = null;
        $this->img = null;
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
            if ($this->collProjectDetails) {
                foreach ($this->collProjectDetails as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aContactRelatedByFkContactClientId instanceof Persistent) {
              $this->aContactRelatedByFkContactClientId->clearAllReferences($deep);
            }
            if ($this->aContactRelatedByFkContactEmployerId instanceof Persistent) {
              $this->aContactRelatedByFkContactEmployerId->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collProjectDetails instanceof PropelCollection) {
            $this->collProjectDetails->clearIterator();
        }
        $this->collProjectDetails = null;
        $this->aContactRelatedByFkContactClientId = null;
        $this->aContactRelatedByFkContactEmployerId = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ProjectPeer::DEFAULT_STRING_FORMAT);
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
