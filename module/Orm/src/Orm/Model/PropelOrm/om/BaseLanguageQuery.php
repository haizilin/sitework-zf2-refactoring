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
use Orm\Model\PropelOrm\CategoryDetail;
use Orm\Model\PropelOrm\Language;
use Orm\Model\PropelOrm\LanguagePeer;
use Orm\Model\PropelOrm\LanguageQuery;
use Orm\Model\PropelOrm\ProjectDetail;
use Orm\Model\PropelOrm\ServiceDetail;

/**
 * Base class that represents a query for the 'language' table.
 *
 *
 *
 * @method LanguageQuery orderById($order = Criteria::ASC) Order by the id column
 * @method LanguageQuery orderByLocale($order = Criteria::ASC) Order by the locale column
 * @method LanguageQuery orderByActive($order = Criteria::ASC) Order by the active column
 *
 * @method LanguageQuery groupById() Group by the id column
 * @method LanguageQuery groupByLocale() Group by the locale column
 * @method LanguageQuery groupByActive() Group by the active column
 *
 * @method LanguageQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LanguageQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LanguageQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LanguageQuery leftJoinCategoryDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the CategoryDetail relation
 * @method LanguageQuery rightJoinCategoryDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CategoryDetail relation
 * @method LanguageQuery innerJoinCategoryDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the CategoryDetail relation
 *
 * @method LanguageQuery leftJoinServiceDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the ServiceDetail relation
 * @method LanguageQuery rightJoinServiceDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ServiceDetail relation
 * @method LanguageQuery innerJoinServiceDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the ServiceDetail relation
 *
 * @method LanguageQuery leftJoinProjectDetail($relationAlias = null) Adds a LEFT JOIN clause to the query using the ProjectDetail relation
 * @method LanguageQuery rightJoinProjectDetail($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ProjectDetail relation
 * @method LanguageQuery innerJoinProjectDetail($relationAlias = null) Adds a INNER JOIN clause to the query using the ProjectDetail relation
 *
 * @method Language findOne(PropelPDO $con = null) Return the first Language matching the query
 * @method Language findOneOrCreate(PropelPDO $con = null) Return the first Language matching the query, or a new Language object populated from the query conditions when no match is found
 *
 * @method Language findOneByLocale(string $locale) Return the first Language filtered by the locale column
 * @method Language findOneByActive(boolean $active) Return the first Language filtered by the active column
 *
 * @method array findById(int $id) Return Language objects filtered by the id column
 * @method array findByLocale(string $locale) Return Language objects filtered by the locale column
 * @method array findByActive(boolean $active) Return Language objects filtered by the active column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseLanguageQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLanguageQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'PropelOrm', $modelName = 'Orm\\Model\\PropelOrm\\Language', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LanguageQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     LanguageQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LanguageQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LanguageQuery) {
            return $criteria;
        }
        $query = new LanguageQuery();
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
     * @return   Language|Language[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LanguagePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LanguagePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Language A model object, or null if the key is not found
     * @throws   PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return   Language A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `id`, `locale`, `active` FROM `language` WHERE `id` = :p0';
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
            $obj = new Language();
            $obj->hydrate($row);
            LanguagePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Language|Language[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Language[]|mixed the list of results, formatted by the current formatter
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
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(LanguagePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(LanguagePeer::ID, $keys, Criteria::IN);
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
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(LanguagePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the locale column
     *
     * Example usage:
     * <code>
     * $query->filterByLocale('fooValue');   // WHERE locale = 'fooValue'
     * $query->filterByLocale('%fooValue%'); // WHERE locale LIKE '%fooValue%'
     * </code>
     *
     * @param     string $locale The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByLocale($locale = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($locale)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $locale)) {
                $locale = str_replace('*', '%', $locale);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LanguagePeer::LOCALE, $locale, $comparison);
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
     * @return LanguageQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(LanguagePeer::ACTIVE, $active, $comparison);
    }

    /**
     * Filter the query by a related CategoryDetail object
     *
     * @param   CategoryDetail|PropelObjectCollection $categoryDetail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LanguageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByCategoryDetail($categoryDetail, $comparison = null)
    {
        if ($categoryDetail instanceof CategoryDetail) {
            return $this
                ->addUsingAlias(LanguagePeer::ID, $categoryDetail->getFkLangId(), $comparison);
        } elseif ($categoryDetail instanceof PropelObjectCollection) {
            return $this
                ->useCategoryDetailQuery()
                ->filterByPrimaryKeys($categoryDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCategoryDetail() only accepts arguments of type CategoryDetail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CategoryDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function joinCategoryDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CategoryDetail');

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
            $this->addJoinObject($join, 'CategoryDetail');
        }

        return $this;
    }

    /**
     * Use the CategoryDetail relation CategoryDetail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\CategoryDetailQuery A secondary query class using the current class as primary query
     */
    public function useCategoryDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCategoryDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CategoryDetail', '\Orm\Model\PropelOrm\CategoryDetailQuery');
    }

    /**
     * Filter the query by a related ServiceDetail object
     *
     * @param   ServiceDetail|PropelObjectCollection $serviceDetail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LanguageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByServiceDetail($serviceDetail, $comparison = null)
    {
        if ($serviceDetail instanceof ServiceDetail) {
            return $this
                ->addUsingAlias(LanguagePeer::ID, $serviceDetail->getFkLangId(), $comparison);
        } elseif ($serviceDetail instanceof PropelObjectCollection) {
            return $this
                ->useServiceDetailQuery()
                ->filterByPrimaryKeys($serviceDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByServiceDetail() only accepts arguments of type ServiceDetail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ServiceDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function joinServiceDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ServiceDetail');

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
            $this->addJoinObject($join, 'ServiceDetail');
        }

        return $this;
    }

    /**
     * Use the ServiceDetail relation ServiceDetail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\ServiceDetailQuery A secondary query class using the current class as primary query
     */
    public function useServiceDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinServiceDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ServiceDetail', '\Orm\Model\PropelOrm\ServiceDetailQuery');
    }

    /**
     * Filter the query by a related ProjectDetail object
     *
     * @param   ProjectDetail|PropelObjectCollection $projectDetail  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   LanguageQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByProjectDetail($projectDetail, $comparison = null)
    {
        if ($projectDetail instanceof ProjectDetail) {
            return $this
                ->addUsingAlias(LanguagePeer::ID, $projectDetail->getFkLangId(), $comparison);
        } elseif ($projectDetail instanceof PropelObjectCollection) {
            return $this
                ->useProjectDetailQuery()
                ->filterByPrimaryKeys($projectDetail->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByProjectDetail() only accepts arguments of type ProjectDetail or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ProjectDetail relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function joinProjectDetail($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ProjectDetail');

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
            $this->addJoinObject($join, 'ProjectDetail');
        }

        return $this;
    }

    /**
     * Use the ProjectDetail relation ProjectDetail object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\ProjectDetailQuery A secondary query class using the current class as primary query
     */
    public function useProjectDetailQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinProjectDetail($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ProjectDetail', '\Orm\Model\PropelOrm\ProjectDetailQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Language $language Object to remove from the list of results
     *
     * @return LanguageQuery The current query, for fluid interface
     */
    public function prune($language = null)
    {
        if ($language) {
            $this->addUsingAlias(LanguagePeer::ID, $language->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}
