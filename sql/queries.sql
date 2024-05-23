-- 8) query to get the number of applications per broker
select
    customers.uuid,
    customers.email,
    customers.first_name,
    customers.last_name,
    count(applications.uuid) as application_count
from
    customers
        left join applications on applications.broker_id = customers.uuid
where
    is_broker = 1
GROUP BY
    customers.uuid

-- 9) query to get a list of applications and their status transitions, per broker
select
    customers.uuid,
    customers.email,
    customers.first_name,
    customers.last_name,
    application_history.application_id,
    GROUP_CONCAT(application_history.new_status ORDER BY application_history.created_at ASC) as status_transitions
from
    customers
        inner join applications on applications.broker_id = customers.uuid
        inner join application_history on applications.uuid = application_history.application_id
where
    is_broker = 1
group by
    customers.uuid, application_history.application_id


-- 10) query showing customers with incomplete address history
select
    customer_id,
    customers.first_name,
    customers.last_name,
    SUM(TIMESTAMPDIFF(month, start_date, if (end_date is null, NOW(), end_date))) as months_covered
from
    address_history
        inner join
    customers
    ON address_history.customer_id = customers.uuid AND customers.is_broker = 0
group by
    customer_id
having
    months_covered < 60
