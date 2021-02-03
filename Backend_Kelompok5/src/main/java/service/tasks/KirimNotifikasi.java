package service.tasks;

import org.camunda.bpm.engine.delegate.DelegateExecution;
import org.camunda.bpm.engine.delegate.JavaDelegate;

public class KirimNotifikasi implements JavaDelegate {
    @Override
    public void execute(DelegateExecution delegateExecution) throws Exception{
        System.out.println("Notofikasi diterima : "+delegateExecution.getVariable("nama"));
    }
}