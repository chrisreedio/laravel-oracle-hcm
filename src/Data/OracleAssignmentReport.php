<?php

namespace ChrisReedIO\OracleHCM\Data;

readonly class OracleAssignmentReport extends OracleData
{
    public function __construct(
        public ?int $personId,
        public ?string $personNumber,
        public ?int $assignmentId,
        public ?string $assignmentNumber,
        public ?string $assignmentName,
        public ?string $displayName,
        public ?string $relationshipType,
        public ?int $level,
        public ?int $managerId,
        public ?string $managerPersonNumber,
        public ?int $managerAssignmentId,
        public ?string $managerAssignmentNumber,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            personId: $data['PersonId'],
            personNumber: $data['PersonNumber'],
            assignmentId: $data['AssignmentId'],
            assignmentNumber: $data['AssignmentNumber'],
            assignmentName: $data['AssignmentName'],
            displayName: $data['DisplayName'],
            relationshipType: $data['RelationshipType'],
            level: $data['Level'],
            managerId: $data['ManagerId'],
            managerPersonNumber: $data['ManagerPersonNumber'],
            managerAssignmentId: $data['ManagerAssignmentId'],
            managerAssignmentNumber: $data['ManagerAssignmentNumber'],
        );
    }
}
