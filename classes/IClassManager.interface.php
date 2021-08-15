<?php
/*
 * Trait for SQL Manager
 */

interface IClassManager {
	public function getList(int $pageNumber, int $limit = 11);
}
