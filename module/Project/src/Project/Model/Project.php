<?php
namespace Project\Model;

use Orm\Model\PropelOrm;

class Project
{
    private $_query;
    public function __construct() {
        $this->_query = new PropelOrm\ProjectQuery();

    }

    public function getQuery($langId = 2, $sortOrder = null) {
        if (is_null($sortOrder)) {
            $sortOrder = \Criteria::DESC;
        }
        return PropelOrm\ProjectQuery::create()
            ->filterByActive(1)
            ->orderByStartedAt($sortOrder)
            ->joinContactRelatedByFkContactClientId()
            ->joinContactRelatedByFkContactClientId()
            ->joinProjectDetail()
            ->useProjectDetailQuery()
            ->filterByFkLangId($langId)
            ->endUse();
    }
}
