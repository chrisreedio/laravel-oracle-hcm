<?php

namespace ChrisReedIO\OracleHCM\Data;

use ChrisReedIO\OracleHCM\Data\Traits\HasOracleID;

readonly class OracleJob extends OracleData
{
    use HasOracleID;

    public function __construct(
        public ?int $oracle_id,
        public string $code,
        public ?int $job_family_id,
        public bool $is_active,
        public ?string $full_part_time,
        public ?string $job_function_code,
        public ?string $manager_level,
        public bool $medical_checkup_required,
        public ?float $standard_working_hours,
        public ?string $standard_working_frequency,
        public ?float $standard_annual_working_duration,
        public ?string $annual_working_duration_units,
        public ?string $regular_temporary,
        public int $set_id,
        public string $effective_start_date,
        public ?string $effective_end_date,
        public string $name,
        public ?int $approval_authority,
        public ?string $scheduling_group,
        public ?int $grade_ladder_id,
        public string $creation_date,
        public string $last_update_date,
    ) {}

    public static function fromArray(array $data): self
    {
        $endDate = $data['EffectiveEndDate'] !== null ? $data['EffectiveEndDate'] : null;
        if ($endDate === '4712-12-31') {
            $endDate = null;
        }

        return new OracleJob(
            oracle_id: $data['JobId'] ?? null,
            code: $data['JobCode'],
            job_family_id: $data['JobFamilyId'] ?? null,
            is_active: $data['ActiveStatus'] === 'A',
            full_part_time: $data['FullPartTime'] ?? null,
            job_function_code: $data['JobFunctionCode'] ?? null,
            manager_level: $data['ManagerLevel'] ?? null,
            medical_checkup_required: ($data['MedicalCheckupRequired'] ?? 'N') === 'Y',
            standard_working_hours: isset($data['StandardWorkingHours']) ? (float) $data['StandardWorkingHours'] : null,
            standard_working_frequency: $data['StandardWorkingFrequency'] ?? null,
            standard_annual_working_duration: isset($data['StandardAnnualWorkingDuration']) ? (float) $data['StandardAnnualWorkingDuration'] : null,
            annual_working_duration_units: $data['AnnualWorkingDurationUnits'] ?? null,
            regular_temporary: $data['RegularTemporary'] ?? null,
            set_id: $data['SetId'],
            effective_start_date: $data['EffectiveStartDate'],
            effective_end_date: $endDate,
            name: $data['Name'],
            approval_authority: $data['ApprovalAuthority'] ?? null,
            scheduling_group: $data['SchedulingGroup'] ?? null,
            grade_ladder_id: $data['GradeLadderId'] ?? null,
            creation_date: $data['CreationDate'],
            last_update_date: $data['LastUpdateDate'],
        );
    }
}
