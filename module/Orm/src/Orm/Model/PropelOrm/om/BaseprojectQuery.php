<?php

namespace Orm\Model\PropelOrm\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Orm\Model\PropelOrm\contact;
use Orm\Model\PropelOrm\project;
use Orm\Model\PropelOrm\projectDetail;
use Orm\Model\PropelOrm\projectPeer;
use Orm\Model\PropelOrm\projectQuery;

/**
 * Base class that represents a query for the 'project' table.
 *
 *
 *
 * @method projectQuery orderById($order = Criteria::ASC) Order by the id column
 * @method projectQuery orderByFkContactClientId($order = Criteria::ASC) Order by the fk_contact_client_id column
 * @method projectQuery orderByFkContactEmployerId($order = Criteria::ASC) Order by the fk_contact_employer_id column
 * @method projectQuery orderByStartedAt($order = Criteria::ASC) Order by the started_at column
 * @method projectQuery orderByFinishedAt($order = Criteria::ASC) Order by the finished_at column
 * @method projectQuery orderByUrl($order = Criteria::ASC) Order by the url column
 * @method projectQuery orderByImg($order = Criteria::ASC) Order by the img column
 * @method projectQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method projectQuery groupById() Group by the id column
 * @method projectQuery groupByFkContactClientId() Group by the fk_contact_client_id column
 * @method projectQuery groupByFkContactEmployerId() Group by the fk_contact_employer_id column
 * @method projectQuery groupByStartedAt() Group by the started_at column
 * @method projectQuery groupByFinishedAt() Group by the finished_at column
 * @method projectQuery groupByUrl() Group by the url column
 * @method projectQuery groupByImg() Group by the img column
 * @method projectQuery groupByActive() Group by the active column
 *
 * @method projectQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method projectQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method projectQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method projectQuery leftJoincontactRelatedByFkContactClientId($relationAlias = null) Adds a LEFT JOIN clause to the query using the contactRelatedByFkContactClientId relation
 * @method projectQuery rightJoincontactRelatedByFkContactClientId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the contactRelatedByFkContactClientId relation
 * @method projectQuery innerJoincontactRelatedByFkContactClientId($relationAlias = null) Adds a INNER JOIN clause to the query using the contactRelatedByFkContactClientId relation
 *
 * @method projectQuery leftJoincontactRelatedByFkContactEmployerId($relationAlias = null) Adds a LEFT JOIN clause to the query using the contactRelatedByFkContactEmployerId relation
 * @method projectQuery rightJoincontactRelatedByFkContactEmployerId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the contactRelatedByFkContactEmployerId relation
 * @method projectQuery innerJoincontactRelatedByFkContactEmployerId($relationAlias = null) Adds a INNER JOIN clause to the query using the contactRelatedByFkContactEmployerId relation
 *
 * @method projectQuery leftJoinprojectDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the projectDetail relation
 * @method projectQuery rightJoinprojectDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the projectDetail relation
 * @method projectQuery innerJoinprojectDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the projectDetail relation
 *
 * @method project findOne(PropelPDO $con = null) Return the first project matching the query
 * @method project findOneOrCreate(PropelPDO $con = null) Return the first project matching the query, or a new project object populated from the query conditions when no match is found
 *
 * @method project findOneById(int $id) Return the first project filtered by the id column
 * @method project findOneByFkContactClientId(int $fk_contact_client_id) Return the first project filtered by the fk_contact_client_id column
 * @method project findOneByFkContactEmployerId(int $fk_contact_employer_id) Return the first project filtered by the fk_contact_employer_id column
 * @method project findOneByStartedAt(string $started_at) Return the first project filtered by the started_at column
 * @method project findOneByFinishedAt(string $finished_at) Return the first project filtered by the finished_at column
 * @method project findOneByUrl(string $url) Return the first project filtered by the url column
 * @method project findOneByImg(string $img) Return the first project filtered by the img column
 * @method project findOneByActive(boolean $active) Return the first project filtered by the active column
 *
 * @method array findById(int $id) Return project objects filtered by the id column
 * @method array findByFkContactClientId(int $fk_contact_client_id) Return project objects filtered by the fk_contact_client_id column
 * @method array findByFkContactEmployerId(int $fk_contact_employer_id) Return project objects filtered by the fk_contact_employer_id column
 * @method array findByStartedAt(string $started_at) Return project objects filtered by the started_at column
 * @method array findByFinishedAt(string $finished_at) Return project objects filtered by the finished_at column
 * @method array findByUrl(string $url) Return project objects filtered by the url column
 * @method array findByImg(string $img) Return project objects filtered by the img column
 * @method array findByActive(boolean $active) Return project objects filtered by the active column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseprojectQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseprojectQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'PropelOrm', $modelName = 'Orm\\Model\\PropelOrm\\project', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new projectQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     projectQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return projectQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof projectQuery) {
            return $criteria;
        }
        $query = new projectQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   project|project[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = projectPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(projectPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   project A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `ID`, `FK_CONTACT_CLIENT_ID`, `FK_CONTACT_EMPLOYER_ID`, `STARTED_AT`, `FINISHED_AT`, `URL`, `IMG`, `ACTIVE` FROM `project` WHERE `ID` = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new project();
            $obj->hydrate($row);
            projectPeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return project|project[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|project[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(projectPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(projectPeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(projectPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the fk_contact_client_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFkContactClientId(1234); // WHERE fk_contact_client_id = 1234
     * $query->filterByFkContactClientId(array(12, 34)); // WHERE fk_contact_client_id IN (12, 34)
     * $query->filterByFkContactClientId(array('min' => 12)); // WHERE fk_contact_client_id > 12
     * </code>
     *
     * @see       filterBycontactRelatedByFkContactClientId()
     *
     * @param     mixed $fkContactClientId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByFkContactClientId($fkContactClientId = null, $comparison = null)
    {
        if (is_array($fkContactClientId)) {
            $useMinMax = false;
            if (isset($fkContactClientId['min'])) {
                $this->addUsingAlias(projectPeer::FK_CONTACT_CLIENT_ID, $fkContactClientId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkContactClientId['max'])) {
                $this->addUsingAlias(projectPeer::FK_CONTACT_CLIENT_ID, $fkContactClientId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(projectPeer::FK_CONTACT_CLIENT_ID, $fkContactClientId, $comparison);
    }

    /**
     * Filter the query on the fk_contact_employer_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFkContactEmployerId(1234); // WHERE fk_contact_employer_id = 1234
     * $query->filterByFkContactEmployerId(array(12, 34)); // WHERE fk_contact_employer_id IN (12, 34)
     * $query->filterByFkContactEmployerId(array('min' => 12)); // WHERE fk_contact_employer_id > 12
     * </code>
     *
     * @see       filterBycontactRelatedByFkContactEmployerId()
     *
     * @param     mixed $fkContactEmployerId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByFkContactEmployerId($fkContactEmployerId = null, $comparison = null)
    {
        if (is_array($fkContactEmployerId)) {
            $useMinMax = false;
            if (isset($fkContactEmployerId['min'])) {
                $this->addUsingAlias(projectPeer::FK_CONTACT_EMPLOYER_ID, $fkContactEmployerId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($fkContactEmployerId['max'])) {
                $this->addUsingAlias(projectPeer::FK_CONTACT_EMPLOYER_ID, $fkContactEmployerId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(projectPeer::FK_CONTACT_EMPLOYER_ID, $fkContactEmployerId, $comparison);
    }

    /**
     * Filter the query on the started_at column
     *
     * Example usage:
     * <code>
     * $query->filterByStartedAt('2011-03-14'); // WHERE started_at = '2011-03-14'
     * $query->filterByStartedAt('now'); // WHERE started_at = '2011-03-14'
     * $query->filterByStartedAt(array('max' => 'yesterday')); // WHERE started_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $startedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByStartedAt($startedAt = null, $comparison = null)
    {
        if (is_array($startedAt)) {
            $useMinMax = false;
            if (isset($startedAt['min'])) {
                $this->addUsingAlias(projectPeer::STARTED_AT, $startedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($startedAt['max'])) {
                $this->addUsingAlias(projectPeer::STARTED_AT, $startedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(projectPeer::STARTED_AT, $startedAt, $comparison);
    }

    /**
     * Filter the query on the finished_at column
     *
     * Example usage:
     * <code>
     * $query->filterByFinishedAt('2011-03-14'); // WHERE finished_at = '2011-03-14'
     * $query->filterByFinishedAt('now'); // WHERE finished_at = '2011-03-14'
     * $query->filterByFinishedAt(array('max' => 'yesterday')); // WHERE finished_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $finishedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByFinishedAt($finishedAt = null, $comparison = null)
    {
        if (is_array($finishedAt)) {
            $useMinMax = false;
            if (isset($finishedAt['min'])) {
                $this->addUsingAlias(projectPeer::FINISHED_AT, $finishedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($finishedAt['max'])) {
                $this->addUsingAlias(projectPeer::FINISHED_AT, $finishedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(projectPeer::FINISHED_AT, $finishedAt, $comparison);
    }

    /**
     * Filter the query on the url column
     *
     * Example usage:
     * <code>
     * $query->filterByUrl('fooValue');   // WHERE url = 'fooValue'
     * $query->filterByUrl('%fooValue%'); // WHERE url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $url The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByUrl($url = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($url)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $url)) {
                $url = str_replace('*', '%', $url);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(projectPeer::URL, $url, $comparison);
    }

    /**
     * Filter the query on the img column
     *
     * Example usage:
     * <code>
     * $query->filterByImg('fooValue');   // WHERE img = 'fooValue'
     * $query->filterByImg('%fooValue%'); // WHERE img LIKE '%fooValue%'
     * </code>
     *
     * @param     string $img The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByImg($img = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($img)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $img)) {
                $img = str_replace('*', '%', $img);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(projectPeer::IMG, $img, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(projectPeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related contact object
     *
     * @param   contact|PropelObjectCollection $contact The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   projectQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBycontactRelatedByFkContactClientId($contact, $comparison = null)
    {
        if ($contact instanceof contact) {
            return $this
                ->addUsingAlias(projectPeer::FK_CONTACT_CLIENT_ID, $contact->getId(), $comparison);
        } elseif ($contact instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(projectPeer::FK_CONTACT_CLIENT_ID, $contact->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBycontactRelatedByFkContactClientId() only accepts arguments of type contact or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the contactRelatedByFkContactClientId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function joincontactRelatedByFkContactClientId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('contactRelatedByFkContactClientId');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'contactRelatedByFkContactClientId');
        }

        return $this;
    }

    /**
     * Use the contactRelatedByFkContactClientId relation contact object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\contactQuery A secondary query class using the current class as primary query
     */
    public function usecontactRelatedByFkContactClientIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joincontactRelatedByFkContactClientId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'contactRelatedByFkContactClientId', '\Orm\Model\PropelOrm\contactQuery');
    }

    /**
     * Filter the query by a related contact object
     *
     * @param   contact|PropelObjectCollection $contact The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   projectQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBycontactRelatedByFkContactEmployerId($contact, $comparison = null)
    {
        if ($contact instanceof contact) {
            return $this
                ->addUsingAlias(projectPeer::FK_CONTACT_EMPLOYER_ID, $contact->getId(), $comparison);
        } elseif ($contact instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(projectPeer::FK_CONTACT_EMPLOYER_ID, $contact->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBycontactRelatedByFkContactEmployerId() only accepts arguments of type contact or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the contactRelatedByFkContactEmployerId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function joincontactRelatedByFkContactEmployerId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('contactRelatedByFkContactEmployerId');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'contactRelatedByFkContactEmployerId');
        }

        return $this;
    }

    /**
     * Use the contactRelatedByFkContactEmployerId relation contact object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\contactQuery A secondary query class using the current class as primary query
     */
    public function usecontactRelatedByFkContactEmployerIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joincontactRelatedByFkContactEmployerId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'contactRelatedByFkContactEmployerId', '\Orm\Model\PropelOrm\contactQuery');
    }

    /**
     * Filter the query by a related projectDetail object
     *
     * @param   projectDetail|PropelObjectCollection $projectDetail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   projectQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByprojectDetail($projectDetail, $comparison = null)
    {
        if ($projectDetail instanceof projectDetail) {
            return $this
                ->addUsingAlias(projectPeer::ID, $projectDetail->getFkProjectId(), $comparison);
        } elseif ($projectDetail instanceof PropelObjectCollection) {
            return $this
                ->useprojectDetailQuery()
                ->filterByPrimaryKeys($projectDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByprojectDetail() only accepts arguments of type projectDetail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the projectDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function joinprojectDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('projectDetail');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'projectDetail');
        }

        return $this;
    }

    /**
     * Use the projectDetail relation projectDetail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\projectDetailQuery A secondary query class using the current class as primary query
     */
    public function useprojectDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinprojectDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'projectDetail', '\Orm\Model\PropelOrm\projectDetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   project $project Object to remove from the list of results
     *
     * @return projectQuery The current query, for fluid interface
     */
    public function prune($project = null)
    {
        if ($project) {
            $this->addUsingAlias(projectPeer::ID, $project->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
