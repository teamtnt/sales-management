## contacts

- id [primary]
- salutation [string, nullable]
- firstname [string]
- lastname [string]
- job_title [string, nullable]
- email [string, nullable]
- phone [string, nullable]
- updated_at [datetime]
- created_at [datetime]

## companies

- id [primary]
- name [string]
- vat [string, nullable]
- url [string, nullable]
- email [string, nullable]
- address [string, nullable]
- postal [string, nullable]
- city [string, nullable]
- country [string, nullable]
- updated_at [datetime]
- created_at [datetime]

## company_contact

- id
- company_id
- contact_id

## campaign_lists

- id
- name [string]
- description [string, nullable]
- pipeline_id [int]
- updated_at [datetime]
- created_at [datetime]

## leads

- id
- campaign_list_id [int]
- contact_id [int]
- stage [string|pipeline]
- created_at [datetime]
- updated_at [datetime]

## lists

- id
- name [int]
- description [string]
- created_at [datetime]
- updated_at [datetime]

## list_contacts

- id
- list_id
- contact_id

## deals

- id [primary]
- name [string]
- description [string]
- worth [number]
- updated_at [datetime]
- created_at [datetime]

## notes

- id [primary]
- lead_id [int]
- text [text]
- create_by [id|users]
- updated_at [datetime]
- created_at [datetime]

## pipelines

- id [primary]
- name
- stages [json]

## lead_activity

- id [primary]
- user_id [int]
- lead_id [int]
- description [string]
- updated_at [datetime]
- created_at [datetime]

## reminders

- id [primary]
- lead_id [int]
- note [text]
- satus [string]
- remind_on [datetime|nullable]
- updated_at [datetime]
- created_at [datetime]

