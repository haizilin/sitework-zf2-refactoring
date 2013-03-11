<?php
namespace Project\Model;

use Orm\Model\PropelOrm;

class Project
{
    private $_query;
    public function __construct() {
        $this->_query = new PropelOrm\ProjectQuery();

    }

    public function getQuery($langId = 2) {
        return PropelOrm\ProjectQuery::create()
            ->filterByActive(1)
            ->joinContactRelatedByFkContactClientId()
            ->joinContactRelatedByFkContactClientId()
            ->joinProjectDetail()
            ->useProjectDetailQuery()
            ->filterByFkLangId($langId)
            ->endUse();
    }
}
