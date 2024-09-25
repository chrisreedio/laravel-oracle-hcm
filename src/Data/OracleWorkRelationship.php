<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

use function array_key_exists;

readonly class OracleWorkRelationship extends OracleData
{
    use HasOracleID;

    public function __construct(
        public ?int $oracle_id,
        public ?string $legislation_code,
        public ?int $legal_entity_id,
        public ?string $legal_employer_name,
        public ?string $worker_type,
        public bool $primary_flag,
        public ?string $start_date,
        public ?string $legal_employer_seniority_date,
        public ?string $enterprise_seniority_date,
        public bool $on_military_service_flag,
        public ?string $worker_number,
        public ?bool $ready_to_convert_flag,
        public ?string $termination_date,
        public ?string $notification_date,
        public ?string $last_working_date,
        public ?string $revoke_user_access,
        public ?string $recommended_for_rehire,
        public ?string $recommendation_reason,
        public ?int $recommendation_authorized_by_person_id,
        public ?string $created_by,
        public ?string $creation_date,
        public ?string $last_updated_by,
        public ?string $last_update_date,
        public ?string $projected_termination_date,
        /** @var OracleAssignment[] $assignments */
        public array $assignments,
    ) {
        //
    }

    public static function fromArray(array $data): self
    {
        return new self(
            oracle_id: $data['PeriodOfServiceId'] ?? null,
            legislation_code: $data['LegislationCode'] ?? null,
            legal_entity_id: $data['LegalEntityId'] ?? null,
            legal_employer_name: $data['LegalEmployerName'] ?? null,
            worker_type: $data['WorkerType'] ?? null,
            primary_flag: $data['PrimaryFlag'] ?? false,
            start_date: $data['StartDate'] ?? null,
            legal_employer_seniority_date: $data['LegalEmployerSeniorityDate'] ?? null,
            enterprise_seniority_date: $data['EnterpriseSeniorityDate'] ?? null,
            on_military_service_flag: $data['OnMilitaryServiceFlag'] ?? false,
            worker_number: $data['WorkerNumber'] ?? null,
            ready_to_convert_flag: $data['ReadyToConvertFlag'] ?? null,
            termination_date: $data['TerminationDate'] ?? null,
            notification_date: $data['NotificationDate'] ?? null,
            last_working_date: $data['LastWorkingDate'] ?? null,
            revoke_user_access: $data['RevokeUserAccess'] ?? null,
            recommended_for_rehire: $data['RecommendedForRehire'] ?? null,
            recommendation_reason: $data['RecommendationReason'] ?? null,
            recommendation_authorized_by_person_id: $data['RecommendationAuthorizedByPersonId'] ?? null,
            created_by: $data['CreatedBy'] ?? null,
            creation_date: $data['CreationDate'] ?? null,
            last_updated_by: $data['LastUpdatedBy'] ?? null,
            last_update_date: $data['LastUpdateDate'] ?? null,
            projected_termination_date: $data['ProjectedTerminationDate'] ?? null,
            assignments: array_key_exists('assignments', $data)
                ? array_map(fn ($item) => OracleAssignment::fromArray($item), $data['assignments'])
                : [],
        );
    }
}
