<?php
namespace FileRun\WebDAV\Methods;
use FileRun\Files\Actions\Write;
use FileRun\Files\Actions\Upload\PUT as FPUT;
use FileRun\Perms;

class PUT {

	function run($dav) {
		if (!Perms::check('upload')) {
			$return['status'] = "403 Forbidden";
			echo 'You are not allowed to upload files!';
			exit();
		}

		$toRelativePath = \FM::dirname($dav->FRrelativePath);

		$target = Write\Prepare::prepareDestinationFolder($toRelativePath);
		if (!$target) {
			$dav->status("403 Forbidden");
			echo Write\Prepare::getError()['public'];
			exit();
		}

		$fileName = \FM::basename($dav->FRrelativePath);

		$isOwnCloudChunked = false;
		preg_match('/(?P<name>.*)-chunking-(?P<transferid>\d+)-(?P<chunkcount>\d+)-(?P<index>\d+)/', $fileName, $chunking);
		if ($chunking['chunkcount']) {
			$isOwnCloudChunked = true;
			$fileName = $chunking['name'];
		}

		$upload = FPUT\Prepare::prepare($target, $fileName);
		if (!$upload) {
			$dav->status("403 Forbidden");
			echo FPUT\Prepare::getError();
			exit();
		}

		if ($isOwnCloudChunked) {
			$upload['chunking'] = $chunking;
		}

		$rs = FPUT\Upload::run($upload);
		if (!$rs) {
			$dav->status("409 Conflict");
			echo FPUT\Upload::getError()['public'];
			exit();
		}

		$isComplete = true;
		if ($isOwnCloudChunked) {
			if ($chunking['index'] != $chunking['chunkcount'] - 1) {
				$isComplete = false;
			}
		}

		$headers = [];

		if ($isComplete) {
			if (isset($_SERVER['HTTP_X_OC_MTIME'])) {
				$mtimeStr = $_SERVER['HTTP_X_OC_MTIME'];
				if (is_numeric($mtimeStr)) {
					$mtime = intval($mtimeStr);
					if (touch($upload['targetFile']['fullPath'], $mtime)) {
						$headers[] = 'X-OC-MTime: accepted';
						clearstatcache();
					}
				}
			}
			$etag = $dav->getETag($upload['targetFile']['fullPath']);
			$headers[] = 'Etag: "' . $etag . '"';
		}

		if ($upload['targetFile']['exists']) {
			$dav->status("204 No Content");
		} else {
			$dav->status("201 Created");
		}
		foreach ($headers as $header) {
			header($header);
		}
	}
}