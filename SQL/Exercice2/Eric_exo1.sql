use test;
select agent_code, sum(amount), count(id), avg(amount) as MEANORDER from orders 
where agent_code
 in (SELECT distinct agent_code from orders where amount >= 1000) 
 group by agent_code ORDER BY MEANORDER DESC;