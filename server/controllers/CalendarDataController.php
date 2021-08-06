<?php
class CalendarDataController {
	public function findAll() {
		$collection = array();
		$sql = Tools::getDB()->query('SELECT id, title, start, end, start_time, end_time, url, auth FROM ' . _TCALENDAR_ . ' ORDER BY start DESC');
		if ($res = $sql->fetch_array()) {
			do {
				$tmp = new CalendarData();
				$tmp->SetId($res['id']);
				$tmp->SetTitle($res['title']);
				$tmp->SetStartDate($res['start']);
				$tmp->SetStartTime($res['start_time']);
				$tmp->SetEndDate($res['end']);
				$tmp->SetEndTime($res['end_time']);
				$tmp->SetUrl($res['url']);
				$tmp->SetAuth($res['auth']);
				array_push($collection, $tmp);
			} while ($res = $sql->fetch_array());
		}
		return $collection;
	}
	public function findByUser(User $user) {
		$collection = array();
		$sql = Tools::getDB()->query('SELECT id, title, start, end, start_time, end_time, url, auth FROM ' . _TCALENDAR_ . ' WHERE auth = ' . $user->GetId());
		if ($res = $sql->fetch_array()) {
			do {
				$tmp = new CalendarData();
				$tmp->SetId($res['id']);
				$tmp->SetTitle($res['title']);
				$tmp->SetStartDate($res['start']);
				$tmp->SetStartTime($res['start_time']);
				$tmp->SetEndDate($res['end']);
				$tmp->SetEndTime($res['end_time']);
				$tmp->SetUrl($res['url']);
				$tmp->SetAuth($res['auth']);
				array_push($collection, $tmp);
			} while ($res = $sql->fetch_array());
		}
		return $collection;
	}

	public function addCalendarEvent(CalendarData $calendarData) {
		$retorno = false;
		$optionalParams  = Tools::cleanToDB($calendarData->GetEndDate(), true) . ', ';
		$optionalParams .= Tools::cleanToDB($calendarData->GetStartTime(), true) . ', ';
		$optionalParams .= Tools::cleanToDB($calendarData->GetEndTime(), true) . ', ';
		$optionalParams .= Tools::cleanToDB($calendarData->GetUrl(), true);
		$sql = 'INSERT INTO ' . _TCALENDAR_ . '(title, start, auth, end, start_time, end_time, url) VALUES(' . Tools::cleanToDB($calendarData->GetTitle(), true) . ', ' . Tools::cleanToDB($calendarData->GetStartDate(), true) . ', ' . $calendarData->GetAuth() . ',' . $optionalParams . ')';
		if (Tools::getDB()->query($sql)) {
			$retorno = true;
		}
		return $retorno;
	}

	public function removeCalendarEvent(CalendarData $calendarData) {
		$retorno = false;
		$sql = 'DELETE FROM ' . _TCALENDAR_ . ' WHERE id = ' . $calendarData->GetId() . ';';
		if (Tools::getDB()->query($sql)) {
			$retorno = true;
		}
		return $retorno;
	}
}
