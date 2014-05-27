MAHOUT - JIRA API Wrapper
==========================

How to add the library to your project?
----------------------------------------

In your composer.json

1.  Tell Composer where to find the library in the array of `repositories`
2.  Add the lib as a dependecy in field `require`

```
{
    ...
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/raultm/mahout"
        }
    ],
    ...
	"require": {
		"raultm/mahout": "0.0.*"
	},
}
```

How can I use the library?
---------------------------

1. Credentials [JIRA REST API Example - Basic Authentication](https://developer.atlassian.com/display/JIRADEV/JIRA+REST+API+Example+-+Basic+Authentication)
2. Custom JQL [JIRA REST API Example - Query issues](https://developer.atlassian.com/display/JIRADEV/JIRA+REST+API+Example+-+Query+issues) Maybe you want to retrieve issues from a project or filter.

```php
<?php

namespace App\Models

use Mahout\Http\ClientFactory;
use Mahout\Task\Factory;
use Mahout\Mahout;

$configuration = [
    "user" => "__JIRAUSER__",
    "pass" => "__JIRAPASS__",
    "endpoint" => "__JIRAENDPOINT__"
];
$jql = "__JIRAJQL__";

$client = ClientFactory::getInstance($configuration);
$task = Factory::get("FindIssues", ["jql" => $jql]);
$result = Mahout::setClient($client)->perform($task);

$issues = $result["issues"]
$issueTrs = [];
foreach($issues as $issue){
    $issueId = $issue->getId();
    $issueKey = $issue->getKey();
    $issueSummary = $issue->getSummary();
    $issueTrs[] = "<tr><td>$issueKey</td><td>$issueSummary</td></tr>";
}

echo "<table>" . implode($issuesFormated) . "</table>";

?>

```

Credits
--------

Raúl Tierno [@raultm](https://twitter.com/raultm) Software Developer [@kinetica_mobile](https://twitter.com/kinetica_mobile)

![Kinetica Logo](website/static/logo_kinetica.png)

Open sourcing code from Almendralejo
