<?php

namespace li3_clickatell\extensions;

use li3_clickatell\extensions\model\Behaviors;

class Model extends \lithium\data\Model {

	/**
	 * Catches all context method calls and, if it's proper to call,
	 * starts the API request process. Otherwise invokes the method.
	 *
	 * @access public
	 * @param string $method
	 * @param array $params
	 * @return mixed
	 */
	public static function __callStatic($method, Array $params = array()) {
		switch ($method) {
			case 'authenticate':
			case 'ping':
			case 'send':
			case 'query':
				$self = static::_object();
				$conn = $self::connection();
				return $conn->invokeMethod($method, $params); // forward
				break;
		}

		return $self->invokeMethod($method, $params); // ignore
	}
}

?>