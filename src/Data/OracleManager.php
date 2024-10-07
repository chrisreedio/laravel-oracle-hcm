<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

readonly class OracleManager extends OracleData
{
    use HasOracleID;

    public function __construct(
        public ?int $oracle_id,
        public ?string $oracle_code,
        public ?string $action_code,
        public ?string $start_date,
        public ?string $end_date,
        public ?int $manager_id,
        public ?string $type,
        public ?string $type_meaning,
        public ?string $reason_code,
        public ?string $created_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new OracleManager(
            oracle_id: $data['ManagerAssignmentId'],
            oracle_code: $data['ManagerAssignmentNumber'],
            action_code: $data['ActionCode'],
            start_date: $data['EffectiveStartDate'],
            end_date: $data['EffectiveEndDate'],
            manager_id: $data['AssignmentSupervisorId'],
            type: $data['ManagerType'],
            type_meaning: $data['ManagerTypeMeaning'],
            reason_code: $data['ReasonCode'],
            created_at: $data['CreationDate'],
        );
    }
}
