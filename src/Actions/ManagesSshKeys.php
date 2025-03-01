<?php

declare(strict_types=1);

namespace VanguardBackup\Vanguard\Actions;

use VanguardBackup\Vanguard\Resources\SshKey;

trait ManagesSshKeys
{
    /**
     * Get the Vanguard instance SSH public key.
     *
     * This key can be used for SSH authentication when connecting to remote servers.
     */
    public function getInstanceSshKey(): SshKey
    {
        return new SshKey($this->get('ssh-key'), $this);
    }
}
