<?php
/**
 * User: zach
 * Date: 05/31/2013
 * Time: 15:31:18 pm
 */

namespace Elasticsearch\Endpoints;

use Elasticsearch\Endpoints\AbstractEndpoint;
use Elasticsearch\Common\Exceptions;

/**
 * Class Search
 * @package Elasticsearch\Endpoints
 */
class Search extends AbstractEndpoint
{

    /**
     *TODO Validate auto-generated file
     *     Implement per-class specific functions if required

{
  "search": {
    "documentation": "http://www.elasticsearch.org/guide/reference/api/search/",
    "methods": ["GET", "POST"],
    "url": {
      "path": "/_search",
      "paths": ["/_search", "/{index}/_search", "/{index}/{type}/_search", "/_search/scroll", "/_search/scroll/{scroll_id}"],
      "parts": {
        "index": {
         "type" : "list",
         "description" : "A comma-separated list of index names to search; use `_all` or empty string to perform the operation on all indices"
        },
        "type": {
          "type" : "list",
          "description" : "A comma-separated list of document types to search; leave empty to perform the operation on all types"
        },
        "scroll_id": {
          "type" : "string",
          "description" : "The scroll ID"
        }
      },
      "params": {
        "analyzer": {
          "type" : "string",
          "description" : "The analyzer to use for the query string"
        },
        "analyze_wildcard": {
          "type" : "boolean",
          "description" : "Specify whether wildcard and prefix queries should be analyzed (default: false)"
        },
        "default_operator": {
          "type" : "enum",
          "options" : ["AND","OR"],
          "default" : "OR",
          "description" : "The default operator for query string query (AND or OR)"
        },
        "df": {
          "type" : "string",
          "description" : "The field to use as default where no field prefix is given in the query string"
        },
        "explain": {
          "type" : "boolean",
          "description" : "Specify whether to return detailed information about score computation as part of a hit"
        },
        "fields": {
          "type" : "list",
          "description" : "A comma-separated list of fields to return as part of a hit"
        },
        "from": {
          "type" : "number",
          "description" : "Starting offset (default: 0)"
        },
        "ignore_indices": {
          "type" : "enum",
          "options" : ["none","missing"],
          "default" : "none",
          "description" : "When performed on multiple indices, allows to ignore `missing` ones"
        },
        "indices_boost": {
          "type" : "list",
          "description" : "Comma-separated list of index boosts"
        },
        "lenient": {
          "type" : "boolean",
          "description" : "Specify whether format-based query failures (such as providing text to a numeric field) should be ignored"
        },
        "lowercase_expanded_terms": {
          "type" : "boolean",
          "description" : "Specify whether query terms should be lowercased"
        },
        "operation_threading": {
          "description" : "TODO: ?"
        },
        "preference": {
          "type" : "string",
          "description" : "Specify the shards the operation should be performed on (default: random shard)"
        },
        "q": {
          "type" : "string",
          "description" : "Query in the Lucene query string syntax"
        },
        "routing": {
          "type" : "list",
          "description" : "A comma-separated list of specific routing values"
        },
        "scroll": {
          "type" : "duration",
          "description" : "Specify how long a consistent view of the index should be maintained for scrolled search"
        },
        "scroll_id": {
          "type" : "string",
          "description" : "The scroll ID for scrolled search"
        },
        "search_type": {
          "type" : "enum",
          "options" : ["query_then_fetch", "query_and_fetch", "dfs_query_then_fetch", "dfs_query_and_fetch", "count", "scan"],
          "description" : "Search operation type"
        },
        "size": {
          "type" : "number",
          "description" : "Number of hits to return (default: 10)"
        },
        "sort": {
          "type" : "list",
          "description" : "A comma-separated list of <field>:<direction> pairs"
        },
        "source": {
          "type" : "string",
          "description" : "The URL-encoded request definition using the Query DSL (instead of using request body)"
        },
        "stats": {
          "type" : "list",
          "description" : "Specific 'tag' of the request for logging and statistical purposes"
        },
        "suggest_field": {
          "type" : "string",
          "description" : "Specify which field to use for suggestions"
        },
        "suggest_mode": {
          "type" : "enum",
          "options" : ["missing", "popular", "always"],
          "default" : "missing",
          "description" : "Specify suggest mode"
        },
        "suggest_size": {
          "type" : "number",
          "description" : "How many suggestions to return in response"
        },
        "suggest_text": {
          "type" : "text",
          "description" : "The source text for which the suggestions should be returned"
        },
        "timeout": {
          "type" : "time",
          "description" : "Explicit operation timeout"
        },
        "version": {
          "type" : "boolean",
          "description" : "Specify whether to return document version as part of a hit"
        }
      }
    },
    "body": {
      "description": "The search definition using the Query DSL"
    }
  }
}


     */

    /**
     * @param $query
     *
     * @return $this
     * @throws \Elasticsearch\Common\Exceptions\InvalidArgumentException
     */
    public function setQuery($query)
    {
        if (is_string($query) === true) {
            $this->params['q'] = $query;
            $this->setBody(null);
        } else if (is_array($query) === true) {
            $this->setBody($query);
        } else {
            throw new InvalidArgumentException(
                'Query must be a string or array'
            );
        }

        return $this;
    }

    /**
     * @return string
     */
    protected function getURI()
    {

        $uri   = '/_search';
        $index = $this->index;
        $type = $this->type;
        $scroll_id = $this->scroll_id;

        if (isset($index) === true) {
            $uri = "/$index/_search";
        } elseif (isset($type) === true && isset($index) === true) {
            $uri = "/$index/$type/_search";
        }
 elseif (isset($scroll_id) === true && isset($type) === true && isset($index) === true) {
            $uri = "/_search/scroll";
        }

        return $uri;
    }

    /**
     * @return string[]
     */
    protected function getParamWhitelist()
    {
        return array(
            'analyzer',
            'analyze_wildcard',
            'default_operator',
            'df',
            'explain',
            'fields',
            'from',
            'ignore_indices',
            'indices_boost',
            'lenient',
            'lowercase_expanded_terms',
            'operation_threading',
            'preference',
            'q',
            'routing',
            'scroll',
            'scroll_id',
            'search_type',
            'size',
            'sort',
            'source',
            'stats',
            'suggest_field',
            'suggest_mode',
            'suggest_size',
            'suggest_text',
            'timeout',
            'version',
        );
    }

    /**
     * @return string
     */
    protected function getMethod()
    {
        //TODO Fix Me!
        return 'GET,POST';
    }
}