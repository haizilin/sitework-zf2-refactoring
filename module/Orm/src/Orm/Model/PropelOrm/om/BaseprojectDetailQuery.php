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
use Orm\Model\PropelOrm\language;
use Orm\Model\PropelOrm\project;
use Orm\Model\PropelOrm\projectDetail;
use Orm\Model\PropelOrm\projectDetailPeer;
use Orm\Model\PropelOrm\projectDetailQuery;

/**
 * Base class that represents a query for the 'project_detail' table.
 *
 *
 *
 * @method projectDetailQuery orderByFkProjectId($order = Criteria::ASC) Order by the fk_project_id column
 * @method projectDetailQuery orderByFkLangId($order = Criteria::ASC) Order by the fk_lang_id column
 * @method projectDetailQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method projectDetailQuery orderByDescription($order = Criteria::ASC) Order by the description column
 *
 * @method projectDetailQuery groupByFkProjectId() Group by the fk_project_id column
 * @method projectDetailQuery groupByFkLangId() Group by the fk_lang_id column
 * @method projectDetailQuery groupByLabel() Group by the label column
 * @method projectDetailQuery groupByDescription() Group by the description column
 *
 * @method projectDetailQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method projectDetailQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method projectDetailQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method projectDetailQuery leftJoinproject($relationAlias = null) Adds a LEFT JOIN clause to the query using the project relation
 * @method projectDetailQuery rightJoinproject($relationAlias = null) Adds a RIGHT JOIN clause to the query using the project relation
 * @method projectDetailQuery innerJoinproject($relationAlias = null) Adds a INNER JOIN clause to the query using the project relation
 *
 * @method projectDetailQuery leftJoinlanguage($relationAlias = null) Adds a LEFT JOIN clause to the query using the language relation
 * @method projectDetailQuery rightJoinlanguage($relationAlias = null) Adds a RIGHT JOIN clause to the query using the language relation
 * @method projectDetailQuery innerJoinlanguage($relationAlias = null) Adds a INNER JOIN clause to the query using the language relation
 *
 * @method projectDetail findOne(PropelPDO $con = null) Return the first projectDetail matching the query
 * @method projectDetail findOneOrCreate(PropelPDO $con = null) Return the first projectDetail matching the query, or a new projectDetail object populated from the query conditions when no match is found
 *
 * @method projectDetail findOneByFkProjectId(int $fk_project_id) Return the first projectDetail filtered by the fk_project_id column
 * @method projectDetail findOneByFkLangId(int $fk_lang_id) Return the first projectDetail filtered by the fk_lang_id column
 * @method projectDetail findOneByLabel(string $label) Return the first projectDetail filtered by the label column
 * @method projectDetail findOneByDescription(string $description) Return the first projectDetail filtered by the description column
 *
 * @method array findByFkProjectId(int $fk_project_id) Return projectDetail objects filtered by the fk_project_id column
 * @method array findByFkLangId(int $fk_lang_id) Return projectDetail objects filtered by the fk_lang_id column
 * @method array findByLabel(string $label) Return projectDetail objects filtered by the label column
 * @method array findByDescription(string $description) Return projectDetail objects filtered by the description column
 *
 * @package    propel.generator.PropelOrm.om
 */
abstract class BaseprojectDetailQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseprojectDetailQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'PropelOrm', $modelName = 'Orm\\Model\\PropelOrm\\projectDetail', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new projectDetailQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     projectDetailQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return projectDetailQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof projectDetailQuery) {
            return $criteria;
        }
        $query = new projectDetailQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$fk_project_id, $fk_lang_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   projectDetail|projectDetail[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = projectDetailPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(projectDetailPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return   projectDetail A model object, or null if the key is not found
     * @throws   PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT `FK_PROJECT_ID`, `FK_LANG_ID`, `LABEL`, `DESCRIPTION` FROM `project_detail` WHERE `FK_PROJECT_ID` = :p0 AND `FK_LANG_ID` = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new projectDetail();
            $obj->hydrate($row);
            projectDetailPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return projectDetail|projectDetail[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|projectDetail[]|mixed the list of results, formatted by the current formatter
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
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(projectDetailPeer::FK_PROJECT_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(projectDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(projectDetailPeer::FK_PROJECT_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(projectDetailPeer::FK_LANG_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the fk_project_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFkProjectId(1234); // WHERE fk_project_id = 1234
     * $query->filterByFkProjectId(array(12, 34)); // WHERE fk_project_id IN (12, 34)
     * $query->filterByFkProjectId(array('min' => 12)); // WHERE fk_project_id > 12
     * </code>
     *
     * @see       filterByproject()
     *
     * @param     mixed $fkProjectId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function filterByFkProjectId($fkProjectId = null, $comparison = null)
    {
        if (is_array($fkProjectId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(projectDetailPeer::FK_PROJECT_ID, $fkProjectId, $comparison);
    }

    /**
     * Filter the query on the fk_lang_id column
     *
     * Example usage:
     * <code>
     * $query->filterByFkLangId(1234); // WHERE fk_lang_id = 1234
     * $query->filterByFkLangId(array(12, 34)); // WHERE fk_lang_id IN (12, 34)
     * $query->filterByFkLangId(array('min' => 12)); // WHERE fk_lang_id > 12
     * </code>
     *
     * @see       filterBylanguage()
     *
     * @param     mixed $fkLangId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function filterByFkLangId($fkLangId = null, $comparison = null)
    {
        if (is_array($fkLangId) && null === $comparison) {
            $comparison = Criteria::IN;
        }

        return $this->addUsingAlias(projectDetailPeer::FK_LANG_ID, $fkLangId, $comparison);
    }

    /**
     * Filter the query on the label column
     *
     * Example usage:
     * <code>
     * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
     * $query->filterByLabel('%fooValue%'); // WHERE label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $label The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function filterByLabel($label = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $label)) {
                $label = str_replace('*', '%', $label);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(projectDetailPeer::LABEL, $label, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(projectDetailPeer::DESCRIPTION, $description, $comparison);
    }

    /**
     * Filter the query by a related project object
     *
     * @param   project|PropelObjectCollection $project The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   projectDetailQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterByproject($project, $comparison = null)
    {
        if ($project instanceof project) {
            return $this
                ->addUsingAlias(projectDetailPeer::FK_PROJECT_ID, $project->getId(), $comparison);
        } elseif ($project instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(projectDetailPeer::FK_PROJECT_ID, $project->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByproject() only accepts arguments of type project or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the project relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function joinproject($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('project');

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
            $this->addJoinObject($join, 'project');
        }

        return $this;
    }

    /**
     * Use the project relation project object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\projectQuery A secondary query class using the current class as primary query
     */
    public function useprojectQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinproject($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'project', '\Orm\Model\PropelOrm\projectQuery');
    }

    /**
     * Filter the query by a related language object
     *
     * @param   language|PropelObjectCollection $language The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return   projectDetailQuery The current query, for fluid interface
     * @throws   PropelException - if the provided filter is invalid.
     */
    public function filterBylanguage($language, $comparison = null)
    {
        if ($language instanceof language) {
            return $this
                ->addUsingAlias(projectDetailPeer::FK_LANG_ID, $language->getId(), $comparison);
        } elseif ($language instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(projectDetailPeer::FK_LANG_ID, $language->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBylanguage() only accepts arguments of type language or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the language relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function joinlanguage($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('language');

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
            $this->addJoinObject($join, 'language');
        }

        return $this;
    }

    /**
     * Use the language relation language object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Orm\Model\PropelOrm\languageQuery A secondary query class using the current class as primary query
     */
    public function uselanguageQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinlanguage($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'language', '\Orm\Model\PropelOrm\languageQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   projectDetail $projectDetail Object to remove from the list of results
     *
     * @return projectDetailQuery The current query, for fluid interface
     */
    public function prune($projectDetail = null)
    {
        if ($projectDetail) {
            $this->addCond('pruneCond0', $this->getAliasedColName(projectDetailPeer::FK_PROJECT_ID), $projectDetail->getFkProjectId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(projectDetailPeer::FK_LANG_ID), $projectDetail->getFkLangId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

}
