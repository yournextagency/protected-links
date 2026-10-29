<?php

namespace yournextagency\protectedlinks\console\controllers;

use Craft;
use craft\console\Controller;
use craft\db\Query;
use craft\helpers\Console;
use yii\console\ExitCode;

/**
 * Manages stored protected links.
 */
class LinksController extends Controller
{
    /**
     * Length of a code issued before 5.1.0: a hex SHA-1. Codes issued since are 64 characters long.
     */
    private const LEGACY_CODE_LENGTH = 40;

    /**
     * Rotates the computable codes of links issued before 5.1.0.
     *
     * Those codes were a plain SHA-1 of the link params, so anyone could compute the code for any
     * asset ID. This replaces each of them with a random code, so links issued before the upgrade
     * stop working; templates that call `craft.protectedLinks.link()` issue new links on their next
     * render. Links issued since 5.1.0 cannot be computed without the security key and are left
     * alone, so running the command again changes nothing.
     */
    public function actionRotateLegacyLinks(): int
    {
        $ids = (new Query())
            ->select('id')
            ->from('{{%protectedlinks_links}}')
            ->where('CHAR_LENGTH([[checksum]]) = ' . self::LEGACY_CODE_LENGTH)
            ->column();

        if (!$ids) {
            $this->stdout("No legacy links found.\n", Console::FG_GREEN);
            return ExitCode::OK;
        }

        if (!$this->confirm(sprintf('Rotate the codes of %d legacy links? Links issued before 5.1.0 will stop working.', count($ids)))) {
            return ExitCode::OK;
        }

        $db = Craft::$app->getDb();
        foreach ($ids as $id) {
            $db->createCommand()
                ->update('{{%protectedlinks_links}}', ['checksum' => bin2hex(random_bytes(32))], ['id' => $id], [], false)
                ->execute();
        }

        $this->stdout(sprintf("Rotated the codes of %d legacy links.\n", count($ids)), Console::FG_GREEN);

        return ExitCode::OK;
    }
}
